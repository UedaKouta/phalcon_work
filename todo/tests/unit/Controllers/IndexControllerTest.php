<?php

namespace Todo\Tests\Unit\Controllers;

use Codeception\Test\Unit;
use Todo\App\Controllers\IndexController;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use PHPUnit\Framework\TestCase;

class IndexControllerTest extends \UnitTestCase
{
    public function testIndexAction()
    {
    //     $dispatcher = new Dispatcher;
    //    $dispatcher->forward([
    //         'controller' => 'todos',
    //         'action'     => 'index'
    //     ]);
    $Index = new IndexController;
    
        error_log($result."[". date('Y-m-d H:i:s') . dirname(__DIR__). "にてゲットaaaa\n" , 3, "/Applications/MAMP/htdocs/phalcon_work/todo/log/debug.log");
    

    }
}