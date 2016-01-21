<?php
/**
 * Created by PhpStorm.
 * User: lamur
 * Date: 21/01/2016
 * Time: 19:24
 */


namespace Wish\Model;

use Zend\Db\TableGateway\TableGateway;

class WishTable
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

    public function getWish($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('user_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }


    public function deleteWish($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function saveWish(Device $device,$iduser)
    {
        $data = array(
            'titre' => $device->titre,
            'lien' => $device->lien,
            'user_id' => $iduser,

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
}