<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Modal\Api;
use AppBundle\Form\ApiType;

class DefaultController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/api", name="api", options={"expose"=true})
     */
    public function apiAction(Request $request){
//        $output = $this->get('api_caller')->call(new HttpGetJson($this->getParameter('api_endpoint'), array('username' => 'leadership01' ,'appname' => 'CHARGE_CODE_REQUEST')));
//        $serializer = $this->get('jms_serializer');
//        $apis = $serializer->deserialize(json_encode($output), 'ArrayCollection<AppBundle\Modal\Api>', 'json');
//        $api = $apis[0];

        $api = new Api();
        $form = $this->createForm(new ApiType(), $api);
        $code = 'FORM';
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $code = "REFRESH";
                $api = $form->getData();
            } else {
                $code = "FORM_REFRESH";
            }
        }
        
        $body = $this->renderView('default/api.html.twig',
            array('form' => $form->createView())
        );
        
        return new Response(json_encode(array('code' => $code, 'data' => $body)));
    }
}
