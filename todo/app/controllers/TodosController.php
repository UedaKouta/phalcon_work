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

    public function doneAction($id = '')
    {

    $todo = new Todo();
    $todo = Todo::findFirstById($id);
    if (!$todo) {
        $this->flash->error("todo does not exist");

        return $this->dispatcher->forward(
            [
                "controller" => "about",
                "action"     => "index",
            ]
        );
    }

    $form = new TodosForm;
  
    $todo->status = '2';
    $todo->updated = new Phalcon\Db\RawValue('now()');
    if ($todo->save() == false) {
        foreach ($todo->getMessages() as $message) {
            $this->flash->error((string) $message);
    }
    } else {
        $this->tag->setDefault('title', '');
        $this->flash->success('更新しました。');

        return $this->dispatcher->forward(
            [
                "controller" => "about",
                "action"     => "index",
            ]
        );
    }
    }

    public function editAction($id = '')
    {

    $todo = new Todo();
    $todo = Todo::findFirstById($id);
    if (!$todo) {
        $this->flash->error("todo does not exist");

        return $this->dispatcher->forward(
            [
                "controller" => "about",
                "action"     => "index",
            ]
        );
    }

    $form = new TodosForm;
   
    $title = $this->request->getPost('title', ['string', 'striptags']);

    $todo->title = $title ;
    $todo->updated = new Phalcon\Db\RawValue('now()');
    if ($todo->save() == false) {
        foreach ($todo->getMessages() as $message) {
            $this->flash->error((string) $message);
    }
    } else {
        $this->tag->setDefault('title', '');
        $this->flash->success('更新しました。');

        return $this->dispatcher->forward(
            [
                "controller" => "about",
                "action"     => "index",
            ]
        );
    }
    }


    /**
     * Deletes a company
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $todo = new Todo();
        $todo = Todo::findFirstById($id);
        if (!$todo) {
            $this->flash->error("todo does not exist");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "about",
                    "action"     => "index",
                ]
            );
        }

        if (!$todo->delete()) {
            foreach ($todo->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "about",
                    "action"     => "index",
                ]
            );
        }

        $this->flash->success("id:".$id."  was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "about",
                "action"     => "index",
            ]
        );
    }

}