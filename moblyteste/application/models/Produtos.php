<?php

class Application_Model_Produtos extends Zend_Db_Table {

    protected $_name = 'produtos';
    protected $_primary = 'id';

    function getProdutos($idsCategoria, $idsSubCategoria, $idsCaracteristica) {
        
        //FAZ UMA BUSCA PRIMÁRIA NA TABELA DE CARACTERISTICAS
        $subSelect = $this->select()
                ->setIntegrityCheck(false)
                ->from('produtos_caracteristicas',false)
                ->columns('*');
        
        //O(S) ID(S) VEM EM FORMATO DE ARRAY
        if(sizeof($idsCaracteristica)):            
            foreach($idsCaracteristica as $id):
                $subSelect->where('idcaracteristica = ?', $id);
            endforeach;     
        endif;
        
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('p' => 'produtos'), false)
                ->join(array('pc' => $subSelect ), 'pc.idproduto = p.id', false)
                ->columns(
                        array(
                            'id' => 'p.id',
                            'imagem' => 'p.imagem',
                            'nome' => 'p.nome',
                            'precovenda' => 'p.precovenda'
                        )
                )
                ->group('p.id')
                ->order('p.nome ASC');

        //O(S) ID(S) VEM EM FORMATO DE ARRAY
        if(sizeof($idsCategoria)):
            foreach($idsCategoria as $id):
                $select->where('p.idcategoria = ?', $id);
            endforeach;
        endif;
        
        //O(S) ID(S) VEM EM FORMATO DE ARRAY
        if(sizeof($idsSubCategoria)):
            foreach($idsSubCategoria as $id):
                $select->where('p.idsubcategoria = ?', $id);
            endforeach;  
        endif;
     
        return $this->fetchAll($select);
    }

    function getProduto($id) {
        $select = $this->select()
                ->where('id = ?', $id);

        return $this->fetchRow($select);
    }

}

?>