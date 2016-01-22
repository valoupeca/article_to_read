<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Device\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel; 
 use Device\Model\Device;        
 use Device\Form\DeviceForm;
 use Wish\Form\Wish;

 class DeviceController extends AbstractActionController
 {
     protected $deviceTable;
     
     public function indexAction()
     {

         return new ViewModel(array(
             'devices' => $this->getDeviceTable()->fetchAll(),
         ));
     }




     public function addAction()
     {
         $form = new DeviceForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $device = new Device();
             $form->setInputFilter($device->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $device->exchangeArray($form->getData());
                 $this->getDeviceTable()->saveDevice($device);

                 // Redirect to list of devices
                 return $this->redirect()->toRoute('device');
             }
         }
         return array('form' => $form);
    
     }

     public function editAction()
     {
          {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('device', array(
                 'action' => 'add'
             ));
         }

         try {
             $device = $this->getDeviceTable()->getDevice($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('device', array(
                 'action' => 'index'
             ));
         }

         $form  = new DeviceForm();
         $form->bind($device);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($device->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getDeviceTable()->saveDevice($device);

                 // Redirect to list of device
                 return $this->redirect()->toRoute('device');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }
     }



     public function deleteAction()
      {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('device');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getDeviceTable()->deleteDevice($id);
             }

             // Redirect to list of device
             return $this->redirect()->toRoute('device');
         }

         return array(
             'id'    => $id,
             'device' => $this->getDeviceTable()->getDevice($id)
         );
     }
      public function getDeviceTable()
     {
         if (!$this->deviceTable) {
             $sm = $this->getServiceLocator();
             $this->deviceTable = $sm->get('Device\Model\DeviceTable');
         }
         return $this->deviceTable;
     }




 }

