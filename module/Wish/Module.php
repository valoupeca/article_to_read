<?php
/**
 * Created by PhpStorm.
 * User: lamur
 * Date: 21/01/2016
 * Time: 19:27
 */

namespace Wish;

use Wish\Model\Wish;
use Wish\Model\WishTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Wish\Model\WishTable' =>  function($sm) {
                    $tableGateway = $sm->get('WishTableGateway');
                    $table = new WishTable($tableGateway);
                    return $table;
                },
                'WishTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Wish());
                    return new TableGateway('wish', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}