<?php

class Application_Model_Carrinho extends Zend_Db_Table {

    protected $_name = 'pedidoscarrinho';
    protected $_primary = 'id';

    function getCarrinhos($sessao) {

        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('c' => 'pedidoscarrinho'), false)
                ->joinLeft(array('p' => 'produtos'), 'p.id = c.idproduto', false)
                ->columns(
                        array(
                            'iditem' => 'c.id',
                            'codigo' => 'p.codigo',
                            'nome' => 'p.nome',
                            'precovenda' => 'c.precovenda'
                        )
                )
                ->where('c.sessao = ?', $sessao)
                ->order('c.id ASC');
        return $this->fetchAll($select);
    }

    function getTotalCarrinho($sessao) {

        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from('pedidoscarrinho', false)
                ->columns(
                        array(
                            'valortotal' => 'SUM(precovenda)'
                        )
                )
                ->where('sessao = ?', $sessao);

        $result = $this->fetchRow($select);

        return $result->valortotal;
    }

    function getQtdItens($sessao) {
        $select = $this->select()
                ->from('pedidoscarrinho',false)
                ->columns(array(
                    'totalitens' => 'COUNT(*)'
                ))
                ->where('sessao = ?', $sessao);
        
        return $this->fetchRow($select)->totalitens;
    }

}

?>