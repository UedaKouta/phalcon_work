<?php

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Welcome');
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->flash->notice('This is a sample application of the Phalcon Framework.
                Please don\'t provide us any personal information. Thanks');
            
                return $this;
        }
        error_log($this."[". date('Y-m-d H:i:s') . dirname(__DIR__). "にてゲット\n" , 3, "/Applications/MAMP/htdocs/phalcon_work/todo/log/debug.log");
        return $this;
    }
}
