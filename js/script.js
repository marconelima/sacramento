$(() => {

     $('.navbar-toggler').on('click', event => {
 
         $('.navbar').toggleClass('sidebar-open');
 
         if ($('.navbar').hasClass('sidebar-open')) {
 
             $('<div class="backdrop"></div>').appendTo('body');
 
         } else {
 
             $('.backdrop').remove();
 
         }
 
         $('.backdrop').on('click', event => {
 
             $('.navbar').removeClass('sidebar-open');
             $(event.target).remove();
 
         });
 
     });

     $('.plus').click(function () {
        $("#qtde_prod").val($("#qtde_prod").val()+1);
    });
    $('.minus').click(function () {
        if($("#qtde_prod").val() > 0){
            $("#qtde_prod").val($("#qtde_prod").val()-1);
        }
    });
 
 });


 if(document.querySelector(".btnfiltro")){

    let btn = document.querySelectorAll(".btnfiltro");

    btn.forEach(function(el){
        
        el.addEventListener("click", e => {

            btn.forEach(function(el2){
                if(el2.id == el.id && el.checked == false){

                    el2.checked = false;
                }
            });

            let form = document.querySelector("#formFiltro");

            form.submit();

        });
    });

 }

 if(document.querySelector(".colocarCarrinho")){

    

    let produto = document.querySelectorAll(".colocarCarrinho");

    produto.forEach(function(el){

        el.addEventListener("click", e => {

            let idproduto = el.getAttribute("data-idproduto");
            let quantidade = el.getAttribute("data-quantidade");

            $.ajax({
                type: 'POST',
                url: '/assets/php/ajax.php',
                data: "acao=getColocarCarrinho&produto="+idproduto+"&qtde="+quantidade,
                success: function(formulario) {
                    alert("Produto adicionado no carrinho!");
                    //location.reload();
                }
            });

        });
    });

 }

if (document.querySelector(".menosproduto")) {

    let menos = document.querySelectorAll(".menosproduto");

    menos.forEach(function (el) {

        let produto = el.getAttribute("data-idproduto");

        el.addEventListener("click", e => {
            let quantidade = parseInt(document.querySelector("#prod_" + produto).value);

            let quant = quantidade - 1;

            document.querySelector("#prod_" + produto).value = quant;

            $.ajax({
                type: 'POST',
                url: 'https://www.industriasacramento.com.br/testenovo/php/ajax.php',
                data: "acao=getQuantidadeProdutoCarrinho&id=" + produto + "&quantidade=" + quant,
                success: function (formulario) {
                    console.log("quantidade de produto atualizada!");

                    let preco = parseInt(document.querySelector("#prod_preco_"+produto).text);

                    console.log(preco);
                    console.log(quantidade);

                    let preconovo = preco * quantidade;

                    console.log(preconovo);
                }
            });

        });
    });
}

if (document.querySelector(".maisproduto")) {

    let mais = document.querySelectorAll(".maisproduto");

    mais.forEach(function (el) {
        let produto = el.getAttribute("data-idproduto");

        el.addEventListener("click", (e) => {
            let quantidade = parseInt(document.querySelector("#prod_" + produto).value);

            let quant = quantidade + 1;

            document.querySelector("#prod_" + produto).value = quant;

            $.ajax({
                type: 'POST',
                url: 'https://www.industriasacramento.com.br/testenovo/php/ajax.php',
                data: "acao=getQuantidadeProdutoCarrinho&id=" + produto + "&quantidade=" + quant,
                success: function (formulario) {
                    console.log("quantidade de produto atualizada!");

                    let preco = parseInt(document.querySelector("#prod_preco_"+produto).text);


                    console.log(preco);
                    console.log(quantidade);

                    let preconovo = preco * quantidade;

                    console.log(preconovo);
                }
            });

        });
    });
}

 if (document.querySelector(".detalheProduto")) {
    let produto = document.querySelectorAll(".detalheProduto");

    produto.forEach(function (el) {
    el.addEventListener("click", (e) => {
        let idproduto = el.getAttribute("data-idproduto");

        $.ajax({
        type: "POST",
        //Caminho do arquivo do seu modal
        url:
            "https://www.industriasacramento.com.br/testenovo/paginas/modal.php?produto=" +
            idproduto,
        success: function (data) {
            $(".modal-teste").html(data);
        },
        });
    });
    });
}


