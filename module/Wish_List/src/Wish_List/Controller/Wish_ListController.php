<?php
/**
 * Created by PhpStorm.
 * User: lamur
 * Date: 21/01/2016
 * Time: 18:04
 */

namespace Wish_List\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use WishList\Model\Wish_List;
use WishList\Form\Wish_ListForm;

class Wish_ListController extends AbstractActionController
{
    protected $wishlistTable;

    public function indexAction()
    {

        return new ViewModel(array(
            'wish_lists' => $this->getWishListTable()->fetchAll(),
        ));
    }



    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('wish_list');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getWishListTable()->deleteWishList($id);
            }


            return $this->redirect()->toRoute('wish_list');
        }

        return array(
            'id'    => $id,
            'wish_list' => $this->getWishListTable()->getWishList($id)
        );
    }
    public function getWishListTable()
    {
        if (!$this->wishlistTable) {
            $sm = $this->getServiceLocator();
            $this->wishlistTable = $sm->get('Wish_List\Model\Wish_ListTable');
        }
        return $this->wishlistTable;
    }
}

