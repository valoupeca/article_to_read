<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Device\Form;

 use Zend\Form\Form;

 class DeviceForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('device');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'titre',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Thème',
             ),
         ));
         $this->add(array(
             'name' => 'theme',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Thème',
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
             'name' => 'journal',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nom du Journal',
             ),
         ));
             $this->add(array(
             'name' => 'user_id',
             'type' => 'Number',
             
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
