<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Device\Model;

 use Zend\Db\TableGateway\TableGateway;

 class DeviceTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }


     
     public function getDevice($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveDevice(Device $device)
     {
         $data = array(
             'titre' => $device->titre,
             'theme'  => $device->theme,
             'lien' => $device->lien,
             'journal' => $device->journal,
             
         );

         $id = (int) $device->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getDevice($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Device id does not exist');
             }
         }
     }

     public function deleteDevice($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }