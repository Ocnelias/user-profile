<?php

namespace User\Controller;

use Core\SystemController;
use User\Model\User;
use Application\Controller\ErrorController;

/**
 * Controller for user pages
 */
class UserController extends SystemController
{
    /**
     * Index users page
     */
    public function indexAction()
    {
        $this->addAction();
    }

    /**
     * Add new user action
     */
    public function addAction()
    {

        if ($this->isAuthorize) {
            header('location: ' . $this->config['base_path'].'user/profile');
        }


        if (isset($_POST['submit_add_user'])) {
            $user = new User($this->config);
            if (empty($user->validate($_POST))) {
                $user->addUser([
                    'username' => $_POST['username'],
                    'password' => md5($_POST['password']),
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'description' => $_POST['description'],
                ]);
                header('location: ' . $this->config['base_path'].'user/complete');
            }  else {
                $this->view('user/add',['validation_errors'=>$user->validate($_POST)]);
            }

        } else {
            // load views.
            $this->view('user/add');
        }
    }





    /**
     * Show user profile action
     */
    public function completeAction($userId)
    {

        if ($this->isAuthorize) {
            header('location: ' . $this->config['base_path']);
        }

        $this->view('user/complete');

    }

    /**
     * Show user profile action
     */
    public function profileAction($userId)
    {

        if (!$this->isAuthorize) {
            header('location: ' . $this->config['base_path']);
        }

        $user=new User($this->config);
        $userdata=$user->getUser($_SESSION['userprofile']['auth']['authorize_id']);


        $this->view('user/view',['userdata'=>$userdata]);

    }
}