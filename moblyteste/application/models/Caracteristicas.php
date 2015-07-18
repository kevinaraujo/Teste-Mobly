<?php
    class Application_Model_Caracteristicas extends Zend_Db_Table{
        
        protected $_name = 'caracteristicas';
        protected $_primary = 'id';

        function getCaracteristicas(){

            $select = $this->select()
                    ->order('nome ASC');

            return $this->fetchAll($select);
        }	
    }

?>