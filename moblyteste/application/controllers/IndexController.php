<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        //VALIDANDO AUTENTICACAO
        if (Zend_Auth::getInstance()->hasIdentity()): // LOGADO

            $this->redirect('vitrine');

        else: //USUÁRIO DESCONHECIDO

            $this->redirect('login');
        endif;
    }

    public function logoutAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
       
        $this->redirect('login');
    }

}
