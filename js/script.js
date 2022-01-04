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

 if (document.querySelector(".menosproduto")){
    let campo = document.querySelector("");

    let menos = document.querySelectorAll(".menosproduto");

    menos.forEach(function (el){

        let produto = el.getAttribute("data-idproduto");

        el.addEventListener("click", e => {
            let quantidade = document.querySelector("#prod_"+produto);

            let quant = quantidade - 1;

            quantidade.value = quant;

        });
    });
 }

 if (document.querySelector(".maisproduto")) {
   let campo = document.querySelector("");

   let mais = document.querySelectorAll(".maisproduto");

   mais.forEach(function (el) {
     let produto = el.getAttribute("data-idproduto");

     el.addEventListener("click", (e) => {
       let quantidade = document.querySelector("#prod_" + produto);

       let quant = quantidade + 1;

       quantidade.value = quant;
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


