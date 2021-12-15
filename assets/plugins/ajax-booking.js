// Content Contact Form
$(function () {
    $('#booking .error').hide();

    $("#booking .form-button").click(function () {
        // validate and process form
        // first hide any error messages
        $('#booking .error').hide();

        var datefrom = $("#booking input#datefrom").val();
        var matches = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/.exec(datefrom);
        if (matches == null) {
            $("#booking #datefrom_error").show();
            return false;
        }

        var dateto = $("#booking input#dateto").val();
        var matches = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/.exec(dateto);
        if (matches == null) {
            $("#booking #dateto_error").show();
            return false;
        }

        var adults = $("#booking #adults").val();
        if (adults == "none") {
            $("#booking #adults_error").show();
            return false;
        }

        var children = $("#booking #children").val();
        if ( children == "none") {
            $("#booking #children_error").show();
            return false;
        }

        $('#booking').prepend("<div class=\"alert alert-success fade in\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>Query submited.</strong> We will be in touch soon.</div>");
        $('#booking')[0].reset();

        //var dataString = 'datefrom=' + datefrom + '&dateto=' + datefrom + '&adults=' + adults + '&children=' + children;
        //alert (dataString);return false;

        /*$.ajax({
            type:"POST",
            url:"assets/php/contact-form.php",
            data:dataString,
            success:function () {
                $('#booking').prepend("<div class=\"alert alert-success fade in\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>Contact Form Submitted!</strong> We will be in touch soon.</div>");
                $('#booking')[0].reset();
            }
        });*/
        return false;
    });
});