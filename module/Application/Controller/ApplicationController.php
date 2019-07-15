<?php

namespace Application\Controller;

use Core\SystemController;
use User\Controller\UserController;

class ApplicationController extends SystemController
{
    /**
     * Index Action controller
     */
    public function indexAction()
    {
        $this->config['module'] = 'User';
        $page = new UserController($this->config);
        $page->addAction();
        return;
    }

    /**
     * Switch to selected language
     */
    public function langAction()
    {
        $_SESSION['lang']=$_GET['lang'] ?? $this->config['default_language'];
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
}