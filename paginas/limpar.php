<?php
if (isset($_SESSION['criar'])) {
    unset($_SESSION["carrinho"], $_SESSION['qtde'], $_SESSION['criar']);
}

header("Location: ". $siteUrl);
exit;