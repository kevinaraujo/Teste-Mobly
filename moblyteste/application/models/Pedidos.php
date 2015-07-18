<?php

class Application_Model_Pedidos extends Zend_Db_Table {

    protected $_name = 'pedidos';
    protected $_primary = 'id';

    function getPedidos($idUsuario) {

        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('p' => 'pedidos'), false)
                ->join(array('f' => 'formaspagamento'), 'f.id = p.idforma', false)
                ->columns(
                        array(
                            'codigo' => 'p.codigo',
                            'criadoem' => 'p.criadoem',
                            'total' => 'p.total',
                            'forma' => 'f.descricao'
                        )
                )
                ->where('idusuario = ?', $idUsuario)
                ->order('criadoem DESC');

        return $this->fetchAll($select);
    }

}

?>