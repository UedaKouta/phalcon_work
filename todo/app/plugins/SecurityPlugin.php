<?php

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin
{
	/**
	 * Returns an existing or new access control list
	 *
	 * @returns AclList
	 */
	public function getAcl()
	{
		if (!isset($this->persistent->acl)) {

			$acl = new AclList();

			$acl->setDefaultAction(Acl::DENY);

			// Register roles
			$roles = [
				'users'  => new Role(
					'Users',
					'Member privileges, granted after sign in.'
				),
				'guests' => new Role(
					'Guests',
					'Anyone browsing the site who is not signed in is considered to be a "Guest".'
				)
			];

			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			//Private area resources
			$privateResources = [
				'companies'    => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
				'products'     => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
				'producttypes' => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
				'invoices'     => ['index', 'profile'],
				'todos'        => ['index']
			];
			foreach ($privateResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			//Public area resources
			// $publicResources = [
			// 	'index'      => ['index'],
			// 	'about'      => ['index'],
			// 	'register'   => ['index'],
			// 	'todos'      => ['index'],
			// 	'errors'     => ['show401', 'show404', 'show500'],
			// 	'session'    => ['index', 'register', 'start', 'end'],
			// 	'contact'    => ['index', 'send'],
			// 	'contact2'    => ['index', 'send'],

			// ];
			
            // 公開エリアのリソース (フロントエンド)
            $publicResources = array(
                'index'    => array('index'),
                'about'    => array('index','edit'),
                'register' => array('index'),
                'todos'    => array('index','edit'),
                'errors'   => array('show404', 'show500'),
                'session'  => array('index', 'register', 'start', 'end'),
                'contact'  => array('index', 'send')
            );


			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			// //Grant access to public areas to both users and guests
			// foreach ($roles as $role) {
			// 	foreach ($publicResources as $resource => $actions) {
			// 		foreach ($actions as $action){
			// 			$acl->allow($role->getName(), $resource, $action);
			// 		}
			// 	}
			// }

			// //Grant access to private area to role Users
			// foreach ($privateResources as $resource => $actions) {
			// 	foreach ($actions as $action){
			// 		$acl->allow('Users', $resource, $action);
			// 	}
			// }

			// 公開エリアのアクセス権をユーザーとゲストの双方に与える
            foreach ($roles as $role) {
                foreach ($publicResources as $resource => $actions) {
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            // ユーザーにだけ、プライベートエリアへのアクセス権を与える
            foreach ($privateResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow('Users', $resource, $action);
                }
            }

			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		}

		return $this->persistent->acl;
	}

	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 * @return bool
	 */
	public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
	{
		$auth = $this->session->get('auth');
		if (!$auth){
			$role = 'Guests';
		} else {
			$role = 'Users';
		}

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();

		$acl = $this->getAcl();

		if (!$acl->isResource($controller)) {
			$dispatcher->forward([
				'controller' => 'errors',
				'action'     => 'show404'
			]);

			return false;
		}

		$allowed = $acl->isAllowed($role, $controller, $action);
		if (!$allowed) {
			$dispatcher->forward([
				'controller' => 'errors',
				'action'     => 'show401'
			]);
                        $this->session->destroy();
			return false;
		}
	}
}
