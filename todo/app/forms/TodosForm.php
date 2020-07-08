<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;


/* 
2020/07/08  Add TodosForm  by todo
 */
class TodosForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // title
        $title = new Text('title');
        $title->setLabel('Title');
        $title->setFilters(['striptags', 'string']);
        $title->addValidators([
            new PresenceOf([
                'message' => 'title is required'
            ])
        ]);
        $this->add($title);

    }
}
