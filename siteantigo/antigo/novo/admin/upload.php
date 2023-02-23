    
<?php


// Aqui incluimos a classe upload
include('class.upload.php');

// Verificamos se a acao é igual a imagem
if ($_POST['prod_foto'] == 'imagem') 
{
    // Instanciamos o objeto Upload

    $handle = new Upload($_FILES['imagem']);

    // Então verificamos se o arquivo foi carregado corretamente
    if ($handle->uploaded) 
	{       
        // Definimos as configurações desejadas da imagem maior
        $handle->image_resize            = true;
        $handle->image_ratio_y           = false;
        $handle->image_x                 = 640;
		$handle->image_y                 = 480;
		$handle->image_watermark         = 'watermark.png';
		$handle->image_watermark_x       = -10;
		$handle->image_watermark_y       = -10;
		$handle->image_bevel = 20;
		$handle->image_bevel_color1 = '#FF0000';
		$handle->image_reflection_height = '25%';
		$handle->image_reflection_space = -6;

        // Definimos a pasta para onde a imagem maior será armazenada
        $handle->Process('./imagens/');
        
        // Em caso de sucesso no upload podemos fazer outras ações como insert em um banco de cados

        // Aqui nos devifimos nossas configurações de imagem do thumbs
        $handle->image_resize            = true;
        $handle->image_ratio_y           = false;
        $handle->image_x                 = 270;
		$handle->image_y       			 = 210;
        $handle->image_contrast          = 10;
		$handle->jpeg_quality            = 70;
		$handle->file_new_name_body =    "1";
		
        // Definimos a pasta para onde a imagem thumbs será armazenada
        $handle->Process('./imagens/thumbs/');
        
        // Excluimos os arquivos temporarios
        $handle-> Clean();

    } 
	else 
	{
        // Em caso de erro listamos o erro abaixo
        echo '<fieldset>';
        echo '  <legend>Imagem não enviada no servidor, favor entrar em contato com o administrador do banco.</legend>';
        echo '  Erro: ' . $handle->error . '';
        echo '</fieldset>';
    } 
}

// Aqui somente recupero o nome da imagem caso queira fazer um insert em banco de dados
$nome_da_imagem = $handle->file_dst_name;

echo $nome_da_imagem;
?> 