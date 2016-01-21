<?php
/**
 * Created by PhpStorm.
 * User: lamur
 * Date: 21/01/2016
 * Time: 19:21
 */


namespace Wish\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Wish\Model\Wish;
use Wish\Form\WishForm;

class WishController extends AbstractActionController
{
    protected $wishTable;

    public function indexAction()
    {

        return new ViewModel(array(
            'wishs' => $this->getWishTable()->fetchAll(),
        ));
    }



    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('wish');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getWishTable()->deleteWish($id);
            }


            return $this->redirect()->toRoute('wish');
        }

        return array(
            'id'    => $id,
            'wish' => $this->getWishTable()->getWish($id)
        );
    }
    public function getWishTable()
    {
        if (!$this->wishTable) {
            $sm = $this->getServiceLocator();
            $this->wishTable = $sm->get('Wish\Model\WishTable');
        }
        return $this->wishTable;
    }
    public function addWishAction()
    {
        $form = new WishForm();
        $form->get('submit')->setValue('AddWish');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $wish = new Device();
            $form->setInputFilter($wish->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $wish->exchangeArray($form->getData());
                $this->getDeviceTable()->saveWish($wish);

                // Redirect to list of devices
                return $this->redirect()->toRoute('wish');
            }
        }
        return array('form' => $form);


    }

    public function saveWish(Wish $wish)
    {
        $data = array(
            'titre' => $wish->titre,
            'lien' => $wish->lien,
            'users_id' => $wish->user_id,

        );

        $id = (int) $wish->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getWish($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Wish id does not exist');
            }
        }
    }


}

