$(function(){
    //LOGOUT
    $('.sair').click(function(){
        if(confirm('Deseja realmente sair?')){
            $(location).attr('href','index/logout');
        }
    });
    
    //TELA DE VITRINE PARA FILTRAR
     $('input[name="categoria[]"],input[name="subcategoria[]"],input[name="caracteristica[]"]').click(function(){
        $(this).closest('form').submit();
    });
    
    //EXCLUIR ITEM DO CARRINHO
    $('.excluirItem').click(function(){
        var id = $(this).closest('tr').attr('id');
        
        $(location).attr('href','carrinho/excluir-item/id/' + id);
    });
    
    //FINALIZAR PEDIDO
    $('#finalizarPedido').click(function(){
        var qtdSelecionado = $('input[name=idforma]:checked').length;
        
        if(qtdSelecionado == 0){
            alert('Selecione uma forma de pagamento');
        }else{
            //POST NA FORMA DE PAGAMENTO
            $('form[name=formapagamento]').submit();
        }
    });
});