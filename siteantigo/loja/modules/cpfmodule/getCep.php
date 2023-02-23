<?php
include(dirname(__FILE__).'/../../config/config.inc.php');
$cpfmodule = Module::getInstanceByName('cpfmodule');
echo $cpfmodule->getAddress(Tools::getValue('cep'));
?>
