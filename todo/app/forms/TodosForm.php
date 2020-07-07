<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class TodosForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // title
        $title = new Text('title');
        $title->setLabel('title');
        $title->setFilters(['striptags', 'string']);
        $title->addValidators([
            new PresenceOf([
                'message' => 'title is required'
            ])
        ]);
        $this->add($title);

    }
}
