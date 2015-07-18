<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    public function _initLayout(){
        Zend_Layout::startMvc(array(
           'layout' => 'padrao', 
           'layoutPath' => '../application/views/layout' 
        ));
    }

}

