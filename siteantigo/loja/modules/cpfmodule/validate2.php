<?php
include(dirname(__FILE__).'/../../config/config.inc.php');
$cpfmodule = Module::getInstanceByName('cpfmodule');
$result = (Tools::getIsset('cpf') == true ? $cpfmodule->cpfValidation(Tools::getValue('cpf')) : $cpfmodule->cnpjValidate(Tools::getValue('cnpj')));
if($result == '1') echo json_encode(array("validate"=>"1"));
else echo json_encode(array("validate"=>"0","err"=>"$result"));
?>
