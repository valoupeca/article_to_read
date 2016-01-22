<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ilias
 * Date: 26/11/2015
 * Time: 19:41
 */

namespace Auth\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;

class LoginForm extends Form
{
    public function __construct($name) {

        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
                'id'    => 'email',
                'class' => 'email_input',
            ),
            'options' => array(
                'label' => 'Email',
                'label_attributes' => array(
                    'class' => 'emaillabel',
                ),
                'id' => 'email',
            )
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'id'    => 'password',
                'class' => 'pssw_input',
            ),
            'options' => array(
                'label' => 'Password',
                'label_attributes' => array(
                    'class' => 'password_label',
                ),
                'id' => 'password',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'loginCsrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3600
                )
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Keep reading',
                'class' => 'btn btn-default btn-xl',
            ),
        ));
    }
}