<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\ChargeCodeRequest;
use AppBundle\Entity\Activity;
use AppBundle\Form\ChargeCodeRequestType;
use AppBundle\Form\RejectChargeCodeRequestType;
use AppBundle\Form\ApproveChargeCodeRequestType;
use AppBundle\Form\AssignChargeCodeRequestType;

class RequestController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {        
        return $this->redirect($this->generateUrl('_requests'));
    }
    
    /**
     * @Route("/requests/{queryStatus}", name="_requests")
     */
    public function requestsAction(Request $request, $queryStatus = null){    
        return $this->render('AppBundle:Request:index.html.twig', array('queryStatus' => $queryStatus));
    }
    
    /**
     * @Route("/ajax/requests/{queryStatus}", name="_ajax_requests")
     */
    public function ajaxRequestsAction(Request $request, $queryStatus = null){
        $role_checker = $this->get('security.context');
        $repo = $this->getDoctrine()->getRepository('AppBundle:ChargeCodeRequest');
        $qb = $repo->createQueryBuilder('r');
        
        if ($queryStatus == null){
            if($role_checker->isGranted('REQUESTER')){
                $queryStatusArray = array(0,1);
            } else if($role_checker->isGranted('APPROVER')){
                $queryStatusArray = array(1);
            } else {
                $queryStatusArray = array(0,1,2,3);
            }
        } else{
            $queryStatusArray = array($queryStatus);
        }
        
        $qb->where($qb->expr()->in('r.status', $queryStatusArray));
        
        if($role_checker->isGranted('REQUESTER')){
            $requester = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Employee')->findOneBy(array('kerberosId' => $this->getUser()->getCn()));
            $qb->andWhere('r.requester = :requester');
            $qb->setParameter('requester', $requester);
        }
        
        $result = array();
        $result['total'] = count($qb->getQuery()->getResult());
        
        if($request->query->get('search')){
            $qb->andWhere($qb->expr()->like('r.explanation', ':search'))->setParameter('search', '%'.$request->query->get('search').'%');
        }
        
        $ccRequests = $qb->setFirstResult($request->query->get('offset'))
                ->setMaxResults($request->query->get('limit'))->getQuery()->getResult();
        
        $result['rows'] = array();
        foreach($ccRequests as $r){
            $row = array(
                'id' => $r->getId(), 
                'requester' => $r->getRequester()->getKerberosId(),
                'dept' => $r->getEpicDept() ? $r->getEpicDept()->getName() : 'none',
                'admin' => $r->getDeptAdminKId()->getName(),
                'hcpc' => $r->getHcpcs(),
                'modifier' => $r->getModifier()->getName(),
                'system' => $r->getSystem()->getName(),
                'explanation' => $r->getExplanation(),
                'status' => $r->getStatus(),
                'assignee' => $r->getAssignee() ? $r->getAssignee()->getKerberosId() : '',
            );
            $result['rows'][] = $row;
        }
        
        return new JsonResponse($result);
    }
    
    /**
     * @Route("/request/edit/{id}", name="_edit_requests")
     */
    public function editAction(Request $request, $id = 0){
        $em = $this->getDoctrine()->getManager();
        $empRepo = $this->getDoctrine()->getRepository('AppBundle:Employee');
        $user = $this->getUser();
        
        if ($id == 0){
            $ccRequest = new ChargeCodeRequest();
            $ccRequest->setStatus(0);
            $requester = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Employee')->findOneBy(array('kerberosId' => $user->getCn()));
            $ccRequest->setRequester($requester);
        } else {
            $ccRequest = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:ChargeCodeRequest')->find($id);
        }
        
        $formDisabled = false;
        
        if($id > 0 && $ccRequest->getStatus() > 1){
            $formDisabled = true;
        }
        
        $form = $this->createForm(new ChargeCodeRequestType(), $ccRequest, array(
            'em' => $this->getDoctrine()->getManager(), 'disabled' => $formDisabled));
        $code = 'FORM';
        
        // create activity log
        $activity = new Activity();
        $activity->setKerberosId($user->getCn());
        $activity->setActedOn(new \Datetime('now'));
        $activity->setAction('opened');
        
        if($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if($form->isValid()){
                $status = 5;
                if($form->get('save')->isClicked()) {
                    $status = 0;
                    $activity->setAction('updated');
                    if($id == 0){
                        $activity->setAction('drafted');
                    }
                } else if ($form->get('submit')->isClicked()) {
                    $status = 1;
                    $activity->setAction('submitted');
                    $ccRequest->setSubmittedDate(new \DateTime());
                }
                
                $ccRequest->setStatus($status);

                $ccRequest = $form->getNormData();
                $em->persist($ccRequest);
                $em->flush();

                $activity->setRequest($ccRequest);
                $em->persist($activity);
                $em->flush();
                $code = "SCRIPT";
            } else {
                $code = "FORM_REFRESH";
            }
        }
        
        $body = $this->renderView('AppBundle:Request:edit.html.twig', array('form' => $form->createView(), 'ccRequest' => $ccRequest));
        
        $body = $code == 'SCRIPT' ? "$('#table').bootstrapTable('refresh');" : $body;
        
        return new JsonResponse(array('code' => $code, 'data' => $body));
    }
    
    /**
     * @Route("/request/remove/{id}", name="_remove_requests")
     */
    public function removeAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $ccRequest = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:ChargeCodeRequest')->find($id);
        $em->remove($ccRequest);
        $em->flush();
        return new JsonResponse(array('code' => 'SCRIPT', 'data' => "$('#table').bootstrapTable('refresh');"));
    }
    
    /**
     * @Route("ajax/departments/search", name="_ajax_departments_search")
     */
    public function ajaxDepartmentSearchAction()
    {
        $request = $this->container->get('request');
        if($request->isXmlHttpRequest())
        {
            $term = $request->query->get('term');
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:EpicDepartment');

            $query = $repository->createQueryBuilder('d')
                ->where('d.name LIKE  :term')
                ->setParameter('term', '%'.$term.'%')
                ->orderBy('d.name')
                ->getQuery();

            $departmentList = $query->getResult();
            $deptListJson = array();
            foreach ($departmentList as $dept) {
                $deptListJson[] = array(
                    'id' => $dept->getId(),
                    'label' => $dept->getName(),
                    'value' => $dept->getName()
                );
            }

            return new JsonResponse($deptListJson);
        }
    }
    
    /**
     * @Route("ajax/departments/get/{id}", name="_ajax_departments_get")
     */
    public function ajaxDepartmentGetAction($id = null)
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:EpicDepartment');
        $dept = $repository->find($id);
        
        return new Response($dept->getName());
    }

    /**
     * @Route("ajax/employees/search", name="_ajax_employees_search")
     */
    public function ajaxEmployeeSearchAction()
    {
        $request = $this->container->get('request');
        if($request->isXmlHttpRequest())
        {
            $term = $request->query->get('term');
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Employee');

            $query = $repository->createQueryBuilder('e')
                ->where('e.lName LIKE  :term')
                ->orWhere ('e.kerberosId LIKE  :term')
                ->setParameter('term', '%'.$term.'%')
                ->orderBy('e.lName')
                ->getQuery();

            $employeeList = $query->getResult();
            $employeeListJson = array();
            foreach ($employeeList as $emp) {
                $employeeListJson[] = array(
                    'id' => $emp->getId(),
                    'label' => $emp->getKerberosId().'@nyumc.org',
                    'value' => $emp->getKerberosId().'@nyumc.org',
                );
            }

            return new JsonResponse($employeeListJson);
        }
    }
    
    /**
     * @Route("ajax/employees/get/{id}", name="_ajax_employees_get")
     */
    public function ajaxEmployeeGetAction($id = null)
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Employee');
        $emp = $repository->find($id);
        
        return new Response($emp->getKerberosId().'@nyumc.org');
    }
    
    /**
     * @Route("request/reject/{id}", name="_request_reject")
     */
    public function rejectAction(Request $request, $id)
    {
        $em  = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $ccRequest = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:ChargeCodeRequest')->find($id);
        $form = $this->createForm(new RejectChargeCodeRequestType(), $ccRequest);
        $code = 'FORM';
        if($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if($form->isValid()){
                $code = "REFRESH";
                
                $ccRequest = $form->getData();
                $ccRequest->setStatus(3);
                
                $activity = new Activity();
                $activity->setKerberosId($user->getCn());
                $activity->setActedOn(new \Datetime('now'));
                $activity->setAction('rejected');
                $activity->setRequest($ccRequest);

                $em->persist($activity);
                $em->flush();                
            } else {
                $code = "FORM_REFRESH";
            }
        }
        $body = $this->renderView('AppBundle:Request:reject.html.twig', array('form' => $form->createView()));
        return new JsonResponse(array('code' => $code, 'data' => $body));
    }
    
    /**
     * @Route("request/assign/{id}", name="_request_assign")
     */
    public function assignAction(Request $request, $id)
    {
        $em  = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $ccRequest = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:ChargeCodeRequest')->find($id);
        $form = $this->createForm(new AssignChargeCodeRequestType(), $ccRequest);
        $code = 'FORM';
        if($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if($form->isValid()){
                $code = "SCRIPT";
                
                $ccRequest = $form->getData();
                
                $activity = new Activity();
                $activity->setKerberosId($user->getCn());
                $activity->setActedOn(new \Datetime('now'));
                $activity->setAction('assign');
                $activity->setActedTo($ccRequest->getAssignee()->getKerberosId());
                $activity->setRequest($ccRequest);

                $em->persist($activity);
                $em->flush();                
            } else {
                $code = "FORM_REFRESH";
            }
        }
        $body = $this->renderView('AppBundle:Request:assign.html.twig', array('form' => $form->createView()));
        $body = $code == 'SCRIPT' ? "$('#table').bootstrapTable('refresh');" : $body;
        return new JsonResponse(array('code' => $code, 'data' => $body));
    }
    
    /**
     * @Route("request/approve/{id}", name="_request_approve")
     */
    public function approveAction(Request $request, $id)
    {
        $em  = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $ccRequest = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:ChargeCodeRequest')->find($id);
        $form = $this->createForm(new ApproveChargeCodeRequestType(), $ccRequest);
        $code = 'FORM';
        if($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if($form->isValid()){
                $code = "REFRESH";
                
                $ccRequest = $form->getData();
                $ccRequest->setStatus(2);
                
                $activity = new Activity();
                $activity->setKerberosId($user->getCn());
                $activity->setActedOn(new \Datetime('now'));
                $activity->setAction('approved');
                $activity->setRequest($ccRequest);

                $em->persist($activity);
                $em->flush();                
            } else {
                $code = "FORM_REFRESH";
            }
        }
        
        $body = $this->renderView('AppBundle:Request:approve.html.twig', array('form' => $form->createView()));
        return new JsonResponse(array('code' => $code, 'data' => $body));
    }
    
    /**
     * @Route("request/rvu/{id}", name="_request_rvu")
     */
    public function rvuAction(Request $request, $id){
        $ccRequest = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:ChargeCodeRequest')->find($id);
        $body = $this->renderView('AppBundle:Request:rvu.html.twig', array('rvus' => $ccRequest->getRvus()));
        return new JsonResponse(array('code' => 'DATA', 'data' => $body));
    }

}
