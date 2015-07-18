<?php
    class Application_Model_Categorias extends Zend_Db_Table{
        
        protected $_name = 'categorias';
        protected $_primary = 'id';

        function getCategorias(){

            $select = $this->select()
                    ->order('nome ASC');

            return $this->fetchAll($select);
        }	
    }

?>