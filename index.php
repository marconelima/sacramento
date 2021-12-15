<?php include "url.php"; ?>
<?php include "header.php"; ?>
<?php $pagina = ($pagina == '' ? 'home' : $pagina); ?>
<?php include $pasta.'/'.$pagina.'.php'; ?>
<?php include "footer.php"; ?>