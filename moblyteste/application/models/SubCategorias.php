<?php
    class Application_Model_SubCategorias extends Zend_Db_Table{
        
        protected $_name = 'subcategorias';
        protected $_primary = 'id';

        function getSubCategorias(){

            $select = $this->select()
                    ->order('nome ASC');

            return $this->fetchAll($select);
        }	
    }

?>