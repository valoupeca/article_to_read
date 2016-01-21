<?php
/**
 * Created by PhpStorm.
 * User: lamur
 * Date: 21/01/2016
 * Time: 17:57
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Wish_List\Controller\Wish_List' => 'Wish_List\Controller\Wish_ListController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'wish_list' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/wish_list[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Wish_List\Controller\Wish_List',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'wish_list' => __DIR__ . '/../view',
        ),
    ),
);