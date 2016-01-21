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
            'Wish\Controller\Wish' => 'Wish\Controller\WishController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'wish' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/wish[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Wish\Controller\Wish',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'wish' => __DIR__ . '/../view',
        ),
    ),
);