<?php

use Phalcon\Mvc\Model;

/**
 * Products
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

	/**
	 * Products initializer
	 */
	// public function initialize()
	// {
	// 	$this->belongsTo('status', [
	// 		'reusable' => true
	// 	]);
	// }

	/**
	 * Returns a human representation of 'active'
	 *
	 * @return string
	 */
	// public function getActiveDetail()
	// {
	// 	if ($this->active == 'Y') {
	// 		return 'Yes';
	// 	}
	// 	return 'No';
	// }

	// public function validation()
    // {
    //     $validator = new Validation();
        
    //     $validator->add(
    //         'email',
    //         new EmailValidator([
    //         'message' => 'Invalid email given'
    //     ]));
        
    //     return $this->validate($validator);
    // }
}
