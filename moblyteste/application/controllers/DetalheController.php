<?php

class DetalheController extends Zend_Controller_Action {

    public function init() {
        //SESSAO QUE GUARDA A QTD DE ITENS NO CARRINHO
        $this->sessionCarrinho = new Zend_Session_Namespace('carrinho');
        $qtdCarrinho = $this->sessionCarrinho->qtd;

        //MENSAGEM QUE FICARÁ NO MENU DO TOPO
        $msgItens = null;
        $msgItens = ($qtdCarrinho == 1) ? '(' . $qtdCarrinho . ' item)' : $msgItens;
        $msgItens = ($qtdCarrinho > 1) ? '(' . $qtdCarrinho . ' itens)' : $msgItens;
        $this->view->msgItens = $msgItens;


        //VALIDANDO AUTENTICACAO
        if (!Zend_Auth::getInstance()->hasIdentity()): //NAO AUTENTICADO
            $this->redirect('login');
        else:
            //RETORNANDO O NOME DO USUÁRIO LOGADO
            $nomeUsuario = Zend_Auth::getInstance()->getIdentity()->nome;
            $this->view->nomeUsuario = $nomeUsuario;
        endif;
    }

    public function indexAction() {
        //DESCRIPTOGRAFA ID DO PRODUTO
        $idproduto = $this->_request->getParam('produto');
        $id = base64_decode($idproduto);

        $dbp = new Application_Model_Produtos();
        $produto = $dbp->getProduto($id);

        $this->view->produto = $produto;
    }

}
