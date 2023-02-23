<?php
include(dirname(__FILE__).'/../../config/config.inc.php');
$cpfmodule = Module::getInstanceByName('cpfmodule');
$page = Tools::getIsset('page') ? Tools::getValue('page') : false ;
if($page)
{
    $page -= 1;
    echo $cpfmodule->getCustomers($page);
}
?>
