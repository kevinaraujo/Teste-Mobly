<?php

class LoginController extends Zend_Controller_Action {

    public function init() {
        if (Zend_Auth::getInstance()->hasIdentity()): // LOGADO            
            $this->redirect('vitrine');
        endif;
    }

    public function indexAction() {
        //REMOVE O LAYOUT PADRAO
        $this->_helper->layout()->disableLayout();

        $data = $this->_helper->getHelper('FlashMessenger')->getMessages();

        if ($data[0]['erro'] == true):
            $this->view->erro = true;
        endif;
    }

    public function validarAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if ($this->_request->getPost()):
            $emailPost = $this->_request->getPost('email');
            $senhaPost = $this->_request->getPost('senha');

            if (!empty($emailPost) && !empty($senhaPost)):
                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                $adapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

                $adapter->setTableName('usuarios')
                        ->setIdentityColumn('email')
                        ->setCredentialColumn('senha')
                        ->setIdentity($emailPost)
                        ->setCredential($senhaPost);

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($adapter);

                if ($result->isValid()):
                    $storage = $auth->getStorage();
                    $storage->write($adapter->getResultRowObject(null, 'senha'));

                    $this->redirect('vitrine');
                else:
                    $this->retornarErro();
                endif;
            else:
                $this->retornarErro();
            endif;

        endif;
    }

    function retornarErro() {
        $msg = array('erro' => true);
        $this->_helper->getHelper('FlashMessenger')->addMessage($msg);

        $this->redirect('login');
    }

}
