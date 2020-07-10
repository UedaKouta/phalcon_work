<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{

    /* 
    2020/07/08  Add headerMenu todos  by todo
    */
    private $_headerMenu = [
        'navbar-left' => [
            'index' => [
                'caption' => 'Home',
                'action' => 'index'
            ],
            'about' => [
                'caption' => 'About',
                'action' => 'index'
            ],
            'invoices' => [
                'caption' => 'Invoices',
                'action' => 'index'
            ],
            'todos' => [
                'caption' => 'Todo',
                'action' => 'index'
            ],
            'contact' => [
                'caption' => 'Contact',
                'action' => 'index'
            ],

        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Log In/Sign Up',
                'action' => 'index'
            ],
        ]
    ];

    private $_tabs = [
        'Invoices' => [
            'controller' => 'invoices',
            'action' => 'index',
            'any' => false
        ],
        'Companies' => [
            'controller' => 'companies',
            'action' => 'index',
            'any' => true
        ],
        'Products' => [
            'controller' => 'products',
            'action' => 'index',
            'any' => true
        ],
        'Product Types' => [
            'controller' => 'producttypes',
            'action' => 'index',
            'any' => true
        ],
        'Your Profile' => [
            'controller' => 'invoices',
            'action' => 'profile',
            'any' => false
        ]
    ];

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {
        
        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = [
                'caption' => 'Log Out',
                'action' => 'end'
            ];
        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
            
            //2020/07/10  Add unset headerMenu todos  by todo  START
            unset($this->_headerMenu['navbar-left']['todos']);
            //2020/07/10  Add unset headerMenu todos  by todo END
        }

        //2020/07/10  modifi headerMenu layout  by todo  START
        $controllerName = $this->view->getControllerName();
        echo '<div class="collapse navbar-collapse"　 id="bs-example-navbar-collapse-1">';
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            
        }
        echo '</div>';

    }

    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }
}
