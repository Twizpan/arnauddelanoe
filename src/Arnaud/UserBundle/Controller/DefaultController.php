<?php

namespace Arnaud\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function addDefaultAction()
    {
        
        //get user list
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        
        //if no existing user
        if (count($users)<1)
        {
            //create a default user
            $user = $userManager->createUser();
            $user->setUserName('admin');
            $user->setEmail('admin@admin.com');
            $user->setPlainPassword('pass'); // should be random password
            $user->setRoles(array('ROLE_ADMIN'));
            $user->setEnabled(true);
            $userManager->updateUser($user);
        }
    
        return $this->redirect($this->generateUrl('arnaud_main_index'));
    }
}
