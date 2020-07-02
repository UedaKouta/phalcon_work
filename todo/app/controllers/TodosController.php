<?php

class TodosController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('About us');
        parent::initialize();
    }

    public function indexAction()
    {
        $form = new TodosForm;

    if ($this->request->isPost()) {

        $title = $this->request->getPost('title', ['string', 'striptags']);

        // if ($password != $repeatPassword) {
        //     $this->flash->error('Passwords are different');
        //     return false;
        // }

        $todo = new Todo();
        $todo->title = $title ;
        $todo->status = '1';
        $todo->created = new Phalcon\Db\RawValue('now()');
        $todo->updated = new Phalcon\Db\RawValue('now()');
  
        if ($todo->save() == false) {
            foreach ($todo->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
        } else {
            $this->tag->setDefault('title', '');
            $this->flash->success('登録完了しました。');

            return $this->dispatcher->forward(
                [
                    "controller" => "about",
                    "action"     => "index",
                ]
            );
        }
    }

    $this->view->form = $form;
}
}