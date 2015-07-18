<?php
    class Application_Model_FormasPagamento extends Zend_Db_Table{
        
        protected $_name = 'formaspagamento';
        protected $_primary = 'id';

        function getFormas(){

            $select = $this->select()
                    ->order('descricao ASC');

            return $this->fetchAll($select);
        }	
    }

?>