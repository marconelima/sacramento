
<div id="insta"></div>

<script src="/js/jquery.min.js"></script>
<script>
    $(function() {
        let REF = this;
        //defina aqui o token gerado após clicar em  "Generate Token"
        const token = "IGQVJWTEtFZA3I4YkhuSTdtSDcwS093VTBzdXRLYjlPYlZAmSnVuVURYRzRDMjdiUDZA5YXlrVnRQT0JOLTNDZA2poYUJGT0dlM3pHczIwZAV9MaFhmTy16MU5pODgtandRNHJjLW9mV09WTkZAGNk5jSVFKNQZDZD";

        const url = 'https://graph.instagram.com/me/media?access_token=' + token + '&fields=media_url,media_type,caption,permalink';
        //percorremos as imagens recebidas
        $.get(url).then(function(response) {
            let images = response.data;
            let images_content = '<div class="row">';
            for (let c = 0; c < 1; c++) {
                let pic = images[c];
                let caption = pic.caption !== null ? pic.caption : '';
                images_content += '<div class="col-md-3"><a target="_target" href="' + pic.permalink + '"><img title="' + caption + '" alt="' + caption + '" src="' + pic.media_url + '" width="300"></a></div>';
            }
            images_content += '</div>';
            $('#insta').html(images_content);
        });

    });
</script>

