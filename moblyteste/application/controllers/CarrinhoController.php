<?php

class CarrinhoController extends Zend_Controller_Action {

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

        //USADO NO ESTILO DO LINK DO MENU
        $this->view->controllerName = $this->_request->getControllerName();
    }

    public function indexAction() {
        $sessao = Zend_Session::getId();

        //MOSTRANDO OS ITENS DO CARRINHO
        $dbCarrinho = new Application_Model_Carrinho();
        $itens = $dbCarrinho->getCarrinhos($sessao);

        $this->view->itens = $itens;
    }

    public function adicionarItemAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $sessao = Zend_Session::getId();
        $idproduto = $this->_request->getParam('idproduto');

        //BUSCA O PRODUTO PARA OBTER O PRECO
        $dbp = new Application_Model_Produtos();
        $produto = $dbp->getProduto($idproduto);


        //INSERE ITEM NO CARRINHO
        $campos = array(
            'idproduto' => $produto->id,
            'precovenda' => $produto->precovenda,
            'sessao' => $sessao
        );

        $dbCarrinho = new Application_Model_Carrinho();
        $dbCarrinho->insert($campos);

        //OBTEM QUANTIDADE DE ITENS NO CARRINHO
        $qtdCarrinho = $dbCarrinho->getQtdItens($sessao);

        //ATUALIZA QTD NA SESSAO
        $this->sessionCarrinho->qtd = $qtdCarrinho;

        $this->redirect('/carrinho');
    }

    public function excluirItemAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $sessao = Zend_Session::getId();
        $iditem = $this->_request->getParam('id');

        $dbCarrinho = new Application_Model_Carrinho();
        $dbCarrinho->delete('id = ' . $iditem);

        //OBTEM QUANTIDADE DE ITENS NO CARRINHO
        $qtdCarrinho = $dbCarrinho->getQtdItens($sessao);

        //ATUALIZANDO QTD NA SESSAO
        $this->sessionCarrinho->qtd = $qtdCarrinho;

        $this->redirect('/carrinho');
    }

    public function finalizarAction() {
        $sessao = Zend_Session::getId();
        $idUsuario = Zend_Auth::getInstance()->getIdentity()->id;

        //DADOS PESSOAIS
        $dbUsuario = new Application_Model_Usuarios();
        $usuario = $dbUsuario->getUsuarios($idUsuario);

        $this->view->usuario = $usuario;

        //MOSTRANDO OS ITENS DO CARRINHO
        $dbCarrinho = new Application_Model_Carrinho();
        $itens = $dbCarrinho->getCarrinhos($sessao);

        $this->view->itens = $itens;

        //FORMAS DE PAGAMENTO
        $dbForma = new Application_Model_FormasPagamento();
        $formas = $dbForma->getFormas();

        $this->view->formas = $formas;
    }

    public function fecharPedidoAction() {
        $sessao = Zend_Session::getId();
        $idUsuario = Zend_Auth::getInstance()->getIdentity()->id;
        
        //BUSCANDO TOTAL DO CARRINHO
        $dbCarrinho = new Application_Model_Carrinho();
        $totalPedido = $dbCarrinho->getTotalCarrinho($sessao);

        //GERANDO CODIGO DO PEDIDO
        $codigoPedido = rand(100,999) * rand(100,999);
        
        //CRIANDO PEDIDO
        $campos = array(
            'idusuario' => $idUsuario,
            'codigo' => $codigoPedido,
            'total' => $totalPedido,
            'idforma' =>  $this->_request->getPost('idforma')
        );

        $dbPedido = new Application_Model_Pedidos();
        $idPedido = $dbPedido->insert($campos);


        //ATUALIZANDO A CESTA COM O ID DO PEDIDO E LIMPANDO O CAMPO SESSAO
        $campos = array(
            'idpedido' => $idPedido,
            'sessao' => null
        );
        $dbCarrinho->update($campos, " sessao = '" . $sessao . "'");
        
        //ATUALIZANDO QTD NA SESSAO
        $this->sessionCarrinho->qtd = $qtdCarrinho;
        
        //GUARDANDO CODIGO EM UMA
        $msg = array(
            'codigoPedido' => $codigoPedido
        );
        
        $this->_helper->getHelper('FlashMessenger')->addMessage($msg);
        $this->redirect('/carrinho/pedido-finalizado');
    }
    
    public function pedidoFinalizadoAction(){
        $data = $this->_helper->getHelper('FlashMessenger')->getMessages();
        
        //LEVANDO O CODIGO PRA VIEW
        $this->view->codigoPedido = $data[0]['codigoPedido'];
    }

}
