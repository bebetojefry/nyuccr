<?php
namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use IMAG\LdapBundle\User\LdapUser;
use Lsw\ApiCallerBundle\Call\HttpGetJson;

class Voter implements VoterInterface
{
    private $container;
    private $appsec_api;

    static private $userRoles = null;
    public function __construct($container, $api)
    {
        $this->container  = $container;
        $this->appsec_api = $api;
        self::$userRoles = $this->container->get('session')->get('userRoles');
    }

    public function supportsAttribute($attribute)
    {
        // you won't check against a user attribute, so return true
        return true;
    }

    public function supportsClass($class)
    {
        // your voter supports all type of token classes, so return true
        return true;
    }

    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $user = $token->getUser();
        $role = $attributes[0];
        
        if($user instanceof LdapUser){
            if($role == 'ROLE_LDAP'){
                return VoterInterface::ACCESS_GRANTED;
            }

            if(self::$userRoles == null){
                $roles = $this->container->get('appsec')->getRoles($user->getCn());
                //$roles = $this->container->get('api_caller')->call(new HttpGetJson($this->appsec_api, array('username' => $user->getCn(), 'appname' => 'CHARGE_CODE_REQUEST')));
                $userRoles = array();
                if(count($roles) > 0){
                    foreach($roles as $r){
                        $user->addRole($role['name']);
                        //$userRoles[] = $r->name;
                    }
                }                
                
                self::$userRoles = $userRoles;
            }

            if(in_array($role, self::$userRoles)){
                return VoterInterface::ACCESS_GRANTED;
            }

            return VoterInterface::ACCESS_DENIED;
        }
        
        return VoterInterface::ACCESS_DENIED;
    }
}