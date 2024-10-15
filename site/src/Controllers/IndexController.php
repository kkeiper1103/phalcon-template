<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->title = "Hello Index Controller";
    }
}