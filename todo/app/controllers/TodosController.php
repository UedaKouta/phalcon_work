<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TodosController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Todos');
        parent::initialize();
    }

     /**
     * タスク一覧表示
     */
    public function indexAction($statusparam = '')
    {
        $form = new TodosForm;

        if($statusparam == 1 || $statusparam == 2){
            $status = $statusparam;
        } else{
            $status = '';
        }

        //statusにより検索条件となるパラメーターを取得
        $numberPage = 1;
        if ($status != '') {
            $fx['status'] = $status;
            $query = Criteria::fromInput($this->di, "Todo", $fx);
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
            $this->persistent->searchParams = null;
        }

        if($status != ''){
            $todos = Todo::find($parameters);
        } else{
            $todos = Todo::find();
        }

        $paginator = new Paginator(array(
            "data"  => $todos,
            "limit" => 100,
            "page"  => $numberPage
        ));
        $this->view->form = $form;
        $this->view->status = $status;
        $this->view->page = $paginator->getPaginate();
    }

     /**
     * タスク新規登録の処理
     */
    
     public function insertAction()
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
                        "controller" => "todos",
                        "action"     => "index",
                    ]
                );
            }
        }

        $this->view->form = $form;
    }

     /**
     * タスク完了の処理
     */
     public function doneAction($id = '')
    {

        $todo = new Todo();
        $todo = Todo::findFirstById($id);
        
        if (!$todo) {
     
            $this->flash->error("todo does not exist");
            return $this->dispatcher->forward(
                [
                    "controller" => "todos",
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
                    "controller" => "todos",
                    "action"     => "index",
                ]
            );
        }
    }

     /**
     * タスク編集画面へ遷移
     */
    public function editAction($id = '')
    {
        $form = new TodosForm;

        $numberPage = 1;
        if ($id  != '') {
            $fx['id'] = $id;
            $query = Criteria::fromInput($this->di, "Todo", $fx);
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
            $this->persistent->searchParams = null;
        }

        if($status != ''){
            $todos = Todo::find($parameters);
        } else{
            $todos = Todo::find();
        }

        $paginator = new Paginator(array(
            "data"  => $todos,
            "limit" => 100,
            "page"  => $numberPage
        ));
        $this->view->form = $form;
        $this->view->id = $id;
        $this->view->page = $paginator->getPaginate();
    }

    /**
     * タスク内容変更の処理
     */
    public function registerAction($id = '')
    {

        $todo = new Todo();
        $todo = Todo::findFirstById($id);
        if (!$todo) {
            $this->flash->error("todo does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "todos",
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
                    "controller" => "todos",
                    "action"     => "index",
                ]
            );
        }
    }

     /**
     * タスク削除処理
     */
    public function deleteAction($id)
    {

        $todo = new Todo();
        $todo = Todo::findFirstById($id);
        if (!$todo) {
            $this->flash->error("todo does not exist");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "todos",
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
                    "controller" => "todos",
                    "action"     => "index",
                ]
            );
        }

        $this->flash->success("id:".$id."  was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "todos",
                "action"     => "index",
            ]
        );
    }
}