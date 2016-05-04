<?php

namespace AppBundle\EventHandler;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use IMAG\LdapBundle\Event\LdapUserEvent;
use Lsw\ApiCallerBundle\Call\HttpGetJson;
use IMAG\LdapBundle\Event\LdapEvents;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * Performs logic before the user is found to LDAP
 */
class LdapSecuritySubscriber implements EventSubscriberInterface
{   
    private $container;
    private $appsec_api;
    
    public function __construct($container, $api) {
        $this->container = $container;
        $this->appsec_api = $api;
    }

    public static function getSubscribedEvents()
    {
        return array(           
            LdapEvents::POST_BIND => 'onPostBind',
        );
    }
    
    public function onPostBind(LdapUserEvent $event)
    {
        $user = $event->getUser();
        //$roles = $this->container->get('appsec')->getRoles($user->getCn());
        $roles = $this->container->get('api_caller')->call(new HttpGetJson($this->appsec_api, array('username' => $user->getCn(), 'appname' => 'CHARGE_CODE_REQUEST')));
        if(count($roles) > 0){
            //set user default role (ROLE_LDAP)
            $user->addRole('ROLE_LDAP');
            foreach($roles as $role){
                //$user->addRole($role['name']);
                $user->addRole($role->name);
            }
        } else {
            throw new UnsupportedUserException('You are not authorized to use this app.');
        }
        
        $this->container->get('session')->set('userRoles', $user->getRoles());
        
        $event->setUser($user);
    }
}