<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AboutController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Welcome');
        parent::initialize();
    }

    public function indexAction($status = '')
    {

        $form = new TodosForm;

        $numberPage = 1;
        if ($status != '') {
            $query = Criteria::fromInput($this->di, "Todo", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        if($status != ''){
            $todos = Todo::findFirstByStatus($status);
        } else{
            $todos = Todo::find($parameters);
        }
        


        // if (count($products) == 0) {
        //     $this->flash->notice("The search did not find any products");

        //     return $this->dispatcher->forward(
        //         [
        //             "controller" => "products",
        //             "action"     => "index",
        //         ]
        //     );
        // }

        // $todos['status'] = $status;

        $paginator = new Paginator(array(
            "data"  => $todos,
            "limit" => 10,
            "page"  => $numberPage
        ));
        $this->view->form = $form;
        $this->view->status = $status;
        $this->view->page = $paginator->getPaginate();
    }
}
