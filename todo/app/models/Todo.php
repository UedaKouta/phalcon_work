<?php

use Phalcon\Mvc\Model;


/* 
2020/07/08  Add TodoModel  by todo
 */

class Todo extends Model
{
	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var integer
	 */
	public $title;

	/**
	 * @var string
	 */
	public $status;

	/**
	 * @var string
	 */
	public $created;

	/**
	 * @var string
	 */
	public $updated;

/* 
2020/07/13  Add beforeUpdate  by todo
*/
	public function beforeUpdate()
    {
        // Set the modification date
        $this->updated = new Phalcon\Db\RawValue('now()');
    }

}
