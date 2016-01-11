<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Device;

 use Device\Model\Device;
 use Device\Model\DeviceTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;

 class Module  
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
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
                 'Device\Model\DeviceTable' =>  function($sm) {
                     $tableGateway = $sm->get('DeviceTableGateway');
                     $table = new DeviceTable($tableGateway);
                     return $table;
                 },
                 'DeviceTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Device());
                     return new TableGateway('device', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
 