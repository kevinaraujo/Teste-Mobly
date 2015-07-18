<?php

class VitrineController extends Zend_Controller_Action {

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

        //INSTANCIANDO A SESSAO PARA RECUPERAR OU "SETAR" DADOS
        $filtros = new Zend_Session_Namespace('filtros');

        //CATEGORIA
        $dbCategoria = new Application_Model_Categorias();
        $categorias = $dbCategoria->getCategorias();
        $this->view->categorias = $categorias;

        //SUBCATEGORIA
        $dbSubCategoria = new Application_Model_SubCategorias();
        $subCategorias = $dbSubCategoria->getSubCategorias();
        $this->view->subCategorias = $subCategorias;

        //CARACTERÍSTICAS
        $dbCaracteristica = new Application_Model_Caracteristicas();
        $caracteristicas = $dbCaracteristica->getCaracteristicas();
        $this->view->caracteristicas = $caracteristicas;

        //FILTROS
        if ($this->_request->getPost()):
           
            $categoria = $this->_request->getPost('categoria');
        
            //GUARDA O ARRAY DO POST PARA USAR NA VIEW
            $filtros->categoria = $categoria;

            
            $subCategoria = $this->_request->getPost('subcategoria');
            
            //GUARDA O ARRAY DO POST PARA USAR NA VIEW
            $filtros->subCategoria = $subCategoria;

            
            $caracteristica = $this->_request->getPost('caracteristica');

            //GUARDA O ARRAY DO POST PARA USAR NA VIEW
            $filtros->caracteristica = $caracteristica;

        endif;

        //USAR NA VIEW PARA MANTER OS FILTROS
        $this->view->filtros = $filtros;
      
        
        $dbp = new Application_Model_Produtos();
        $produtos = $dbp->getProdutos($filtros->categoria, $filtros->subCategoria, $filtros->caracteristica);
        $this->view->produtos = $produtos;
    }

}
