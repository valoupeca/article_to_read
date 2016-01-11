<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 return array(
     'controllers' => array(
         'invokables' => array(
             'Device\Controller\Device' => 'Device\Controller\DeviceController',
         ),
     ),
     'router' => array(
         'routes' => array(
             'device' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/device[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Device\Controller\Device',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'device' => __DIR__ . '/../view',
         ),
     ),
 );