<?php
$nomeSite = "Industria Sacramento";
$emailSite = "vendas@industriasacramento.com.br";
$linkSite = "https://www.industriasacramento.com.br/testenovo/";


$tituloSite = "Mercadão da Carne BH";
$tituloPainel = "Painel Mercadão da Carne BH";

$posicaoBanner = array('1' => 'Banner Home Principal','2' => 'Banner Médio Grande','3' => 'Banner Meio Esquerda', '4' => 'Banner Meio Direita', '5' => 'Banner Acima Rodapé', '6' => "Banner Rodapé Abaixo Logo", '7' => 'Banner SideBar Produtos', '8' => 'Banner SideBar Blog');
$tipDoc = array('jpg' => 'image_icon.png','gif' => 'image_icon.png','png' => 'image_icon.png','doc' => 'word_icon.png','docx' => 'word_icon.png','pdf' => 'pdf_icon.png','xls' => 'excel_icon.png','xlsx' => 'excel_icon.png', 'ppt' => 'powerpoint_icon.png');

$status_pedido = array('1'=>'Pedido Recebido','2'=>'Pagamento','3'=>'Processamento','4'=>'Faturamento','5'=>'Transportadora','6'=>'Entregue');

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$mesesx = array ('01' => "Janeiro", '02' => "Fevereiro", '03' => "Março", '04' => "Abril", '05' => "Maio", '06' => "Junho", '07' => "Julho", '08' => "Agosto", '09' => "Setembro", '10' => "Outubro", '11' => "Novembro", '12' => "Dezembro");
$diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");

$hoje = getdate();
$dia = $hoje["mday"];
$mesx = $hoje["mon"];
$nomemes = $meses[$mesx];
$anox = $hoje["year"];
$diadasemana = $hoje["wday"];
$nomediadasemana = $diasdasemana[$diadasemana];
$horaacesso = date("H:i");
?>
