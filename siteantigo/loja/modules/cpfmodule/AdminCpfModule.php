<?php

include_once(PS_ADMIN_DIR.'/../classes/AdminTab.php');

class AdminCpfModule extends AdminTab
{
    private $module = 'cpfmodule';

    public function __construct()
    {
        global $cookie, $_LANGADM;

        $langFile = _PS_MODULE_DIR_.$this->module.'/'.Language::getIsoById(intval($cookie->id_lang)).'.php';
        if(file_exists($langFile))
        {
            require_once $langFile;
            foreach($_MODULE as $key=>$value)

            if(substr(strip_tags($key), 0, 5) == 'Admin')
            $_LANGADM[str_replace('_', '', strip_tags($key))] = $value;
        }

        parent::__construct();
    }

    public function display()
	{
		return $this->displayForm();
	}

    public function displayForm()
    {
        $cpfmodule = Module::getInstanceByName('cpfmodule');
        
        $customers = (Customer::getCustomers());

        echo '
            <script type="text/javascript" src="../modules/cpfmodule/js/prototype.js"></script>
            <script type="text/javascript">
            function sendRequest(page)
            {
                document.getElementById(page).style.color = \'blue\';
                new Ajax.Request("../modules/cpfmodule/pagination.php",{method: "post", postBody: \'page=\'+ page, onComplete: showResponse});
                getValues(\'page\');
                document.getElementById(page).style.color = \'blue\';
                $(\'update\').innerHTML = \'Buscando...\';
            }

			function showResponse(req)
            {
                $(\'update\').innerHTML = \'Ok!\';
				$(\'show\').innerHTML= req.responseText;
			}
   
            function getValues(objName)
            {
                var arr = new Array();
                arr = document.getElementsByName(objName);

                for(var i = 0; i < arr.length; i++)
                {
                    var obj = document.getElementsByName(objName).item(i).style.color = \'black\';;
                }
            }
		</script>

        <fieldset>
		<legend><img src="../img/admin/cog.gif" />'.$this->l('Informations').'</legend>';
        echo $cpfmodule->doPaginationLinks();
        echo'  <div id="show" name="show">'.  $cpfmodule->getCustomers(0) .'</div>
       <span style="color:blue;">Ehinarr Solutions - Copyright&copy; 2010-'.date('Y').'</span>
	   </fieldset>';

    }

}

?>
