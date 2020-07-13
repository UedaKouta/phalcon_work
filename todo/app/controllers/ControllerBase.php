<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('INVO | ');
        $this->view->setTemplateAfter('main');
        define('TODO_STATUS_ACTIVE', 1);
        define('TODO_STATUS_DONE', 2);
        define('TODO_STATUS_ALL', 0);
        
    }
}
