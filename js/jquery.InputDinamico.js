// JavaScript Document


$(function () {
    function removeCampo() {
        $(".removerCampos").unbind("click");
        $(".removerCampos").bind("click", function () {
            i=0;
            $(".dados p.campoDados").each(function () {
                i++;
            });
            if (i>1) {
                $(this).parent().remove();
            }
        });
    }
    removeCampo();
    $(".adicionarCampos").click(function () {
        novoCampo = $(".dados p.campoDados:first").clone();
        novoCampo.find("input").val("");
        novoCampo.insertAfter(".dados p.campoDados:last");
        removeCampo();
    });
	
	function removeCampo2() {
        $(".removerCampos2").unbind("click");
        $(".removerCampos2").bind("click", function () {
            i=0;
            $(".dados2 p.campoDados2").each(function () {
                i++;
            });
            if (i>1) {
                $(this).parent().remove();
            }
        });
    }
    removeCampo2();
    $(".adicionarCampos2").click(function () {
        novoCampo = $(".dados2 p.campoDados2:first").clone();
        novoCampo.find("input").val("");
        novoCampo.insertAfter(".dados2 p.campoDados2:last");
        removeCampo2();
    });
});



    
