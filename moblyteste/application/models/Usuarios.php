<?php
    class Application_Model_Usuarios extends Zend_Db_Table{
        
        protected $_name = 'usuarios';
        protected $_primary = 'id';

        function getUsuarios($id){

            $select = $this->select()
                    ->where('id = ?', $id);

            return $this->fetchRow($select);
        }	
    }

?>