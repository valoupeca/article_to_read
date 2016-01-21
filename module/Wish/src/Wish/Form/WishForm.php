<?php
/**
 * Created by PhpStorm.
 * User: lamur
 * Date: 21/01/2016
 * Time: 19:23
 */

namespace Wish\Form;

use Zend\Form\Form;

class WishForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('wish');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'user_id',
            'type' => 'Text',
            'options' => array(
                'label' => 'Vous (id)',
            ),
        ));
        $this->add(array(
            'name' => 'titre',
            'type' => 'titre',
            'options' => array(
                'label' => 'Titre',
            ),
        ));
        $this->add(array(
            'name' => 'lien',
            'type' => 'Text',
            'options' => array(
                'label' => 'Lien (URL)',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}
