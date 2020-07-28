<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/* 
2020/07/08  Add TodosController  by todo
 */

class TodosController extends ControllerBase
{
    // common
    const TODO_STATUS_ACTIVE = 1;
    const TODO_STATUS_DONE = 2;
    const TODO_STATUS_ALL = 0;
        
    public function initialize()
    {
        $this->tag->setTitle('Todos');
        parent::initialize();
    }

    /**
     * タスク一覧表示
     * @param string $statusparam 表示用タスク　ステータス
     */
    public function indexAction($statusparam = '')
    {
        $form = new TodosForm;
        $serchform = new TodoSerchForm;

        if($statusparam == constant('TodosController::TODO_STATUS_ACTIVE') || $statusparam == constant('TodosController::TODO_STATUS_DONE')){
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

        //paginator取得共通処理
        $paginator  = $this->_paginatorTodos($this,$numberPage,$status);

        $this->view->form = $form;
        $this->view->serchform = $serchform;
        $this->view->status = $status;
        $this->view->TODO_STATUS_ALL = constant('TodosController::TODO_STATUS_ALL');
        $this->view->TODO_STATUS_ACTIVE = constant('TodosController::TODO_STATUS_ACTIVE');
        $this->view->TODO_STATUS_DONE = constant('TodosController::TODO_STATUS_DONE');
     
        $this->view->page = $paginator->getPaginate();
    }


    /**
     * 新規作成画面へ　遷移
     * @param string $statusparam 表示用タスク　ステータス
     */
    public function newAction()
    {
        $form = new TodosForm;
        $this->view->form = $form;
     
    }
    
     /**
     * タスク新規登録の処理
     */
    
     public function insertAction()
    {
        $form = new TodosForm;

        if ($this->request->isPost()) {

            //csrf対策チェック　　2020/07/08 by todo
            if ($this->security->checkToken()) {

                $title = $this->request->getPost('title', ['string', 'striptags']);
                $detail = $this->request->getPost('detail', ['string', 'striptags']);

                $todo = new Todo();
                $todo->title = $title ;
                $todo->detail = $detail ;
                $todo->status = constant('TodosController::TODO_STATUS_ACTIVE');
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
            }else{

                $this->dispatcher->forward(
                    [
                        'controller' => 'errors',
                        'action'     => 'show403'
                    ]
                );
                return false;
            }
        }
        $this->view->form = $form;
    }

     /**
     * タスク完了の処理
     * @param string $id タスクのID
     */
     public function doneAction($id = '')
    {

        new Todo();
        $todo = Todo::findFirstById($id);
        
        if (!$todo) {
     
            $this->flash->error('todo does not exist');
            return $this->dispatcher->forward(
                [
                    "controller" => "todos",
                    "action"     => "index",
                ]
            );
        }

        $form = new TodosForm;
        $todo->status = constant('TodosController::TODO_STATUS_DONE');
    
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
     * @param string $id タスクのID
     */
    public function editAction($id = '')
    {
        // $form = new TodosForm;

        $numberPage = 1;
        if ($id  != '') {
            $fx['id'] = $id;
            $query = Criteria::fromInput($this->di, "Todo", $fx);
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        //paginator取得共通処理      
        $paginator  = $this->_paginatorTodos($this,$numberPage,$status);

        new Todo();
        $todo = Todo::findFirstById($id);

        
        $this->view->form = new TodosForm($todo, array('edit' => true));
        $this->view->id = $id;
        $this->view->page = $paginator->getPaginate();
    }

    /**
     * タスク内容変更の処理
     * @param string $id タスクのID
     */
    public function registerAction($id = '')
    {

        //csrf対策チェック　　2020/07/08 by todo
        if ($this->security->checkToken()) {
            
            new Todo();
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
            $detail = $this->request->getPost('detail', ['string', 'striptags']);

            $todo->title = $title ;
            $todo->detail = $detail ;
            // $todo->updated = new Phalcon\Db\RawValue('now()');

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

        }else{
            $this->dispatcher->forward(
                [
                'controller' => 'errors',
                'action'     => 'show403'
                ]
            );
            return false;
        }
    }

     /**
     * タスク削除処理
     * @param string $id タスクのID
     */
    public function deleteAction($id)
    {

        new Todo();
        $todo = Todo::findFirstById($id);
        if (!$todo) {
            $this->flash->error('todo does not exist');
    
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

        $this->flash->success('id:' . $id . ' was deleted');

        return $this->dispatcher->forward(
            [
                "controller" => "todos",
                "action"     => "index",
            ]
        );
    }


     /**
     * タスク検索処理
     */
    public function serchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Todo", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $todos = Todo::find($parameters);
        if (count($todos) == 0) {
            $this->flash->notice("The search did not find any task");

            return $this->dispatcher->forward(
                [
                    "controller" => "todos",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(array(
            "data"  => $todos,
            "limit" => 100,
            "page"  => $numberPage
        ));

        $this->view->TODO_STATUS_ALL = constant('TodosController::TODO_STATUS_ALL');
        $this->view->TODO_STATUS_ACTIVE = constant('TodosController::TODO_STATUS_ACTIVE');
        $this->view->TODO_STATUS_DONE = constant('TodosController::TODO_STATUS_DONE');
        $this->view->page = $paginator->getPaginate();
    }


        /**
     * タスク一覧表示
     * @param string $statusparam 表示用タスク　ステータス
     */
    public function detailsAction($id = '')
    {
        $form = new TodosForm;
        $serchform = new TodoSerchForm;

        // if($statusparam == constant('TodosController::TODO_STATUS_ACTIVE') || $statusparam == constant('TodosController::TODO_STATUS_DONE')){
        //     $status = $statusparam;
        // } else{
        //     $status = '';
        // }

        //statusにより検索条件となるパラメーターを取得
        $numberPage = 1;
        if ($id != '') {
            $fx['id'] = $id;
            $query = Criteria::fromInput($this->di, "Todo", $fx);
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $todos = Todo::find($parameters);
        if (count($todos) == 0) {
            $this->flash->notice("The search did not find any task");

            return $this->dispatcher->forward(
                [
                    "controller" => "todos",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(array(
            "data"  => $todos,
            "limit" => 100,
            "page"  => $numberPage
        ));

        $this->view->form = $form;
        $this->view->serchform = $serchform;
        $this->view->status = $status;
        $this->view->id = $id;
        $this->view->TODO_STATUS_ALL = constant('TodosController::TODO_STATUS_ALL');
        $this->view->TODO_STATUS_ACTIVE = constant('TodosController::TODO_STATUS_ACTIVE');
        $this->view->TODO_STATUS_DONE = constant('TodosController::TODO_STATUS_DONE');
     
        $this->view->page = $paginator->getPaginate();
    }

    /**
     * タスク一覧表示共通処理
     * @param string $datas タスク一覧処理のデータ
     * @param string $numberPage 表示表示画面ページ番号
     * @param string $status 表示用タスク　ステータス
     */
    private function _paginatorTodos($datas,$numberPage,$status)
    {
        $parameters = array($datas,$numberPage);
        if ($datas->persistent->searchParams) {
            $parameters = $datas->persistent->searchParams;
            $datas->persistent->searchParams = null;
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
        
        return $paginator;
    }
}