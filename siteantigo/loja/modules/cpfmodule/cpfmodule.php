<?php
/**
  * Customer's Registration
  * @category Tools
  *
  * @author Ehinarr Elkader/ PrestashopBr
  * @copyright Ehinarr Elhader
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 1.5
  */

class cpfmodule extends Module
{
	private $_html = '';
	private $_postErrors = array();

   	private $required;
   	private $webservice;
   	private $byjgPwd;
   	private $byjgUser;
   	private $bcKey;
  	private $autoCepKey;
  	private $autoCepUser;
  	private $qtyPerPage;

    public function __construct()
    {
        $this->name    = 'cpfmodule';
        $this->tab     = 'Ehinarr Solutions';
        $this->version = 1.5;
        $this->path    = $this->_path;
        $this->qtyPerPage = 100;
        
        if (Configuration::get('CPFMODULE_REQUIRED'))
            $this->required = Configuration::get('CPFMODULE_REQUIRED');
        if (Configuration::get('CPFMODULE_WEBSERVICE'))
            $this->webservice = Configuration::get('CPFMODULE_WEBSERVICE');
        if (Configuration::get('CPFMODULE_BYJGPWD'))
            $this->byjgPwd = Configuration::get('CPFMODULE_BYJGPWD');
        if (Configuration::get('CPFMODULE_BYJGUSER'))
            $this->byjgUser = Configuration::get('CPFMODULE_BYJGUSER');
        if (Configuration::get('CPFMODULE_BCKEY'))
            $this->bcKey = Configuration::get('CPFMODULE_BCKEY');
        if (Configuration::get('CPFMODULE_AUTOCEPUSER'))
            $this->autoCepUser = Configuration::get('CPFMODULE_AUTOCEPUSER');
        if (Configuration::get('CPFMODULE_AUTOCEPKEY'))
            $this->autoCepKey = Configuration::get('CPFMODULE_AUTOCEPKEY');

       	parent::__construct();

        $this->page             = basename(__FILE__, '.php');
  		$this->displayName      = $this->l('CPF Module');
		$this->description      = $this->l('Adds CPF and CNPJ fields in customer\'s registration form.');

  	}
	
	public function install()
 	{
		if (!parent::install()
            OR !$this->registerHook('createAccountTop')
            OR !$this->registerHook('createAccount')
            OR !$this->registerHook('authentication')
            OR !$this->registerHook('adminCustomers')
            OR !$this->installDB()
            OR !$this->installModuleTab()
            OR !Configuration::updateValue('CPFMODULE_REQUIRED', '1')
            OR !Configuration::updateValue('CPFMODULE_WEBSERVICE', 'RV')
            OR !Configuration::updateValue('CPFMODULE_BYJGPWD', '')
            OR !Configuration::updateValue('CPFMODULE_BYJGUSER', '')
            OR !Configuration::updateValue('CPFMODULE_BCKEY', '')
            OR !Configuration::updateValue('CPFMODULE_AUTOCEPUSER', '')
            OR !Configuration::updateValue('CPFMODULE_AUTOCEPKEY', '')
            )
            return false;
            return true;
	}
	
	public function uninstall()
	{
       if (!parent::uninstall()
       OR !Configuration::deleteByName('CPFMODULE_REQUIRED')
       OR !Configuration::deleteByName('CPFMODULE_WEBSERVICE')
       OR !Configuration::deleteByName('CPFMODULE_BYJGPWD')
       OR !Configuration::deleteByName('CPFMODULE_BYJGUSER')
       OR !Configuration::deleteByName('CPFMODULE_BCKEY')
       OR !Configuration::deleteByName('CPFMODULE_AUTOCEPUSER')
       OR !Configuration::deleteByName('CPFMODULE_AUTOCEPKEY')
       OR !$this->uninstallModuleTab()
           //OR !$this->uninstallDB()
           )
          return false;
          return true;
	}

    private function installDB()
    {
        Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'cpfmodule_data` (
            `id_record` INT NOT NULL AUTO_INCREMENT,
	        `doc` VARCHAR (14),
            `type`  VARCHAR (4),
            `idt` VARCHAR (15),
            `id_customer` INT NOT NULL,
            `housenb` VARCHAR (50),
            PRIMARY KEY (`id_record`)
         ) ENGINE = MYISAM;');
           return true;
	}

    private function uninstallDB()
	{
		Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'cpfmodule_data`;');
  		return true;
	}

    private function _postValidation()
	{
        if (Tools::isSubmit('btnSubmit'))
        {
            if (Tools::isEmpty($_POST['required']))
            $this->_postErrors[] = $this->l('Please choose if required or not.');
            if(Tools::getValue('webservice') == 'BYJG')
            {
                if(Tools::isEmpty($_POST['byjgUser']))
                $this->_postErrors[] = $this->l('Please ByJG User is required.');
                if(Tools::isEmpty($_POST['byjgPwd']))
                $this->_postErrors[] = $this->l('Please ByJG Passwordr is required.');
            }
            if(Tools::getValue('webservice') == 'BC')
            {
                if(Tools::isEmpty($_POST['bcKey']))
                $this->_postErrors[] = $this->l('Please Buscar CEP key is required.');
            }
            if(Tools::getValue('webservice') == 'AC')
            {
                if(Tools::isEmpty($_POST['autoCepUser']))
                $this->_postErrors[] = $this->l('Please AutoCep User is required.');
                if(Tools::isEmpty($_POST['autoCepKey']))
                $this->_postErrors[] = $this->l('Please AutoCep Key is required.');
            }

        }
  	}

    private function _postProcess()
	{
       if (Tools::isSubmit('btnSubmit'))
       {
           Configuration::updateValue('CPFMODULE_REQUIRED',Tools::getValue('required'));
           Configuration::updateValue('CPFMODULE_WEBSERVICE',Tools::getValue('webservice'));
           Configuration::updateValue('CPFMODULE_BYJGPWD',Tools::getValue('byjgPwd'));
           Configuration::updateValue('CPFMODULE_BYJGUSER',Tools::getValue('byjgUser'));
           Configuration::updateValue('CPFMODULE_BCKEY',Tools::getValue('bcKey'));
           Configuration::updateValue('CPFMODULE_AUTOCEPUSER',Tools::getValue('autoCepUser'));
           Configuration::updateValue('CPFMODULE_AUTOCEPKEY',Tools::getValue('autoCepKey'));
       }

        $this->_html .= Module::displayConfirmation($this->l('Settings updated'));
    }

	private function _displayCpfmodule()
	{
		$this->_html .= '<img src="../modules/cpfmodule/img/cpf.jpg" alt="" border="0" style="float:left; margin-right:15px;">  <br />
        <span style="color:blue;font-weight:bold;">'.$this->l('- Adds CPF and CNPJ fields in customer\'s registration form.').'</span><br /><br />
        <span style="color:black;font-weight:bold;">'.$this->l('- The module also adds an auto-complete for zip code.').'</span><br /><br /><br /><br />
        ';
    }

    private function _displayForm()
    {
        $this->_html .= '
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
        <fieldset>
		<legend><img src="../img/admin/cog.gif" />'.$this->l('Module Configuration').'</legend>
		<table class="table" border="0" width="900" cellpadding="0" cellspacing="2" id="form">
           <tr>
             <th>'.$this->l('Required:').'</th>
             <td>
             <input type="radio" name="required" value="1" '.(Configuration::get('CPFMODULE_REQUIRED') == '1' ? 'checked="checked" ' : '').' >&nbsp;&nbsp;&nbsp;'.$this->l('Yes').' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="radio" name="required" value="0"  '.(Configuration::get('CPFMODULE_REQUIRED') == '0' ? 'checked="checked" ' : '').' >&nbsp;&nbsp;&nbsp;'.$this->l('No').'
              </td>
              <th colspan="2">'.$this->l('- Is it necessary that the client informs a number?').'</th>
            </tr>
           <tr>
             <th>'.$this->l('Zip Code WebService:').'</th>
             <td colspan="3">
             <input type="radio" name="webservice" value="RV" '.(Configuration::get('CPFMODULE_WEBSERVICE') == 'RV' ? 'checked="checked" ' : '').' >&nbsp;&nbsp;&nbsp;<a href="http://www.republicavirtual.com.br/" alt="Republica Virtual" target="_blank">'.$this->l('Republica Virtual').'</a></input>&nbsp;&nbsp;&nbsp;
             <input type="radio" name="webservice" value="BYJG"  '.(Configuration::get('CPFMODULE_WEBSERVICE') == 'BYJG' ? 'checked="checked" ' : '').' >&nbsp;&nbsp;&nbsp;<a href="http://www.byjg.com.br/" alt="ByJG" target="_blank">'.$this->l('ByJG').'</a></input>&nbsp;&nbsp;&nbsp;
             <input type="radio" name="webservice" value="BC"  '.(Configuration::get('CPFMODULE_WEBSERVICE') == 'BC' ? 'checked="checked" ' : '').' >&nbsp;&nbsp;&nbsp;<a href="http://www.buscarcep.com.br/" alt="Buscar Cep" target="_blank">'.$this->l('Buscar CEP').'</a></input>&nbsp;&nbsp;&nbsp;
             <input type="radio" name="webservice" value="MV"  '.(Configuration::get('CPFMODULE_WEBSERVICE') == 'MV' ? 'checked="checked" ' : '').' >&nbsp;&nbsp;&nbsp;<a href="http://www.midiaville.com.br/" alt="MidiaVille" target="_blank">'.$this->l('MidiaVille').'</a></input>&nbsp;&nbsp;&nbsp;
             <input type="radio" name="webservice" value="CL"  '.(Configuration::get('CPFMODULE_WEBSERVICE') == 'CL' ? 'checked="checked" ' : '').' >&nbsp;&nbsp;&nbsp;<a href="http://ceplivre.pc2consultoria.com/" alt="Cep livre" target="_blank">'.$this->l('Cep Livre').'</a></input>&nbsp;&nbsp;&nbsp;
             <input type="radio" name="webservice" value="AC"  '.(Configuration::get('CPFMODULE_WEBSERVICE') == 'AC' ? 'checked="checked" ' : '').' >&nbsp;&nbsp;&nbsp;<a href="http://www.autocep.com.br" alt="Auto Cep" target="_blank">'.$this->l('Auto Cep').'</a></input>&nbsp;&nbsp;&nbsp;
             </td>
          </tr>
        <tr>
           <th>'.$this->l('ByJG User:').'</th>
           <td><input type="text" name="byjgUser" value="'.htmlentities(Tools::getValue('byjgUser', $this->byjgUser), ENT_COMPAT, 'UTF-8').'" style="width: 200px;" /> </td>
           <th>'.$this->l('ByJG Password:').'</th>
           <td><input type="text" name="byjgPwd" value="'.htmlentities(Tools::getValue('byjgPwd', $this->byjgPwd), ENT_COMPAT, 'UTF-8').'" style="width: 200px;" /> </td>
        </tr>
        <tr>
           <th>'.$this->l('AutoCep User:').'</th>
           <td><input type="text" name="autoCepUser" value="'.htmlentities(Tools::getValue('autoCepUser', $this->autoCepUser), ENT_COMPAT, 'UTF-8').'" style="width: 200px;" /> </td>
           <th>'.$this->l('AutoCep Key:').'</th>
           <td><input type="text" name="autoCepKey" value="'.htmlentities(Tools::getValue('autoCepKey', $this->autoCepKey), ENT_COMPAT, 'UTF-8').'" style="width: 200px;" /> </td>
        </tr>
        <tr>
           <th>'.$this->l('Buscar Cep Key:').'</th>
           <td  colspan="3"><input type="text" name="bcKey" value="'.htmlentities(Tools::getValue('bcKey', $this->bcKey), ENT_COMPAT, 'UTF-8').'" style="width: 300px;" /> </td>
        </tr>
           <tr><td colspan="4" align="right"><input class="button" name="btnSubmit" value="'.$this->l('Update settings').'" type="submit" /></td></tr>
        </table>
       <span style="color:blue;">Ehinarr Solutions - Copyright&copy; 2010-'.date('Y').'</span>
	   </fieldset>
       </form> ';
   }

	public function getContent()
	{
		$this->_html = '<h2>'.$this->displayName.'</h2>';

  		if (!empty($_POST))
		{
			$this->_postValidation();
			if (!sizeof($this->_postErrors))
				$this->_postProcess();
			else
				foreach ($this->_postErrors AS $err)
					$this->_html .= '<div class="alert error">'. $err .'</div>';
		}
		else
		$this->_html .= '<br />';
		$this->_displayCpfModule();
        $this->_displayForm();

		return $this->_html;
	}

	public function hookAdminCustomers($params)
	{
        if (!$this->active)
        return ;

   		$customer = new Customer((int)($params['id_customer']));
        $doc      = $this->getDoc($customer->id);
        
        $div =' <br />
        <h2>'.$this->l('Tax Informations').'</h2>

			<table cellspacing="0" cellpadding="0" class="table">
				<tr>
					<th class="center">'.$this->l('Document').'</th>
					<th class="center">'.$this->l('Number').'</th>
					<th class="center">'.$this->l('Identification Number').'</th>
				</tr>
				<tr class="alt_row">
					<td>'.($doc->type ? strtoupper($doc->type) : 'N/C').'</td>
					<td>'.($doc->number ? $doc->number : 'N/C').'</td>
					<td>'.($doc->number ? $doc->idt : 'N/C').'</td>
				</tr></table>';

        return $div;
	}


 	public function hookCreateAccountTop($params)
	{
        if (!$this->active)
        return ;

        global $smarty;

        $smarty->assign(array(
                    'required' => $this->required,
        			'this_path_ssl' => Tools::getHttpHost(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/'
           ));

        return $this->display(__FILE__, 'cpfmodule.tpl');
	}

	public function hookCreateAccountForm($params)
	{
        return $this->hookCreateAccountTop($params);
	}

	public function hookAuthentication($params)
	{
        if (!$this->active)
        return ;

        global $cookie;

        $doc = $this->getDoc($cookie->id_customer);

        $cookie->__set('number',$doc->number);
        $cookie->__set('type',$doc->type);
        $cookie->__set('idt',$doc->idt);
        return true;
	}

    public function hookCreateAccount($params)
    {
        if (!$this->active)
        return ;

  		$newCustomer = $params['newCustomer'];

  		if (!Validate::isLoadedObject($newCustomer))
        return false;

		$postVars = $params['_POST'];

		if (empty($postVars))
		return false;

        if($postVars['citizen'] == '2')
        {
            $doc  = (!Tools::isEmpty($postVars['cpf']) ? preg_replace("/[^0-9]/", "", $postVars['cpf']) : 0);
            $type = 'cpf';
            $idt  = $postVars['rg'];
            //(!Tools::isEmpty($postVars['rg']) ? preg_replace("/[^0-9]/", "", $postVars['rg']) : 0);
        }
        elseif($postVars['citizen'] == '1')
        {
            $doc  = (!Tools::isEmpty($postVars['cnpj']) ? preg_replace("/[^0-9]/", "", $postVars['cnpj']) : 0);
            $type = 'cnpj';
            $idt  = $postVars['ie'];
            //(!Tools::isEmpty($postVars['ie']) ? preg_replace("/[^0-9]/", "", $postVars['ie']) : 0);
        }

        $data = array('doc' => pSQL($doc), 'type' => pSQL($type), 'idt' => pSQL($idt), 'id_customer' => pSQL($newCustomer->id));
        Db::getInstance()->autoExecute(_DB_PREFIX_.'cpfmodule_data',$data , 'INSERT');

        global $cookie;

        $cookie->__set('number',$doc);
        $cookie->__set('type',$type);
        $cookie->__set('idt',$idt);

        return true;
    }

    public function cpfValidation($item)
    {
        $nulos = array("12345678909","11111111111","22222222222","33333333333","44444444444","55555555555", "66666666666", "77777777777",
            "88888888888", "99999999999", "00000000000");
        /* Retira todos os caracteres que nao sejam 0-9 */
        $cpf = preg_replace("/[^0-9]/", "", $item);

        if (strlen($cpf) <> 11)
        {
             $err =  $this->l('O n&uacutemero deve conter 11 dígitos!');
             return $err;
         }
        if (!is_numeric($cpf))
        {
            $err =  $this->l('Apenas n&uacutemeros são aceitos!');
            return $err;
        }
        /*Retorna falso se houver letras no cpf */

        if (!(preg_match("/[0-9]/", $cpf)))
        {
            $err =  $this->l('Apenas n&uacutemeros são aceitos!');
            return $err;
        }

        /* Retorna falso se o cpf for nulo*/
        if (in_array($cpf, $nulos))
        {
             $err =  $this->l('N&uacutemero nulo. Verifique por favor!');
             return $err;
        }

        if($this->checkDuplicate('doc',$cpf) == true)
        {
             $err =  $this->l('Este n&uacutemero já está cadastrado!');
             return $err;
        }

        /*Calcula o pen�ltimo d�gito verificador*/
        $acum = 0;
        for ($i = 0; $i < 9; $i++)
        {
            $acum += $cpf[$i] * (10 - $i);
        }

        $x = $acum % 11;
        $acum = ($x > 1) ? (11 - $x) : 0;
        /* Retorna falso se o digito calculado eh diferente do passado na string */
        if ($acum != $cpf[9])
        {
             $err =  $this->l('N&uacutemero inválido. Verifique por favor!');
             return $err;
        }
        /*Calcula o �ltimo d�gito verificador*/
        $acum = 0;
        for ($i = 0; $i < 10; $i++)
        {
            $acum += $cpf[$i] * (11 - $i);
        }

        $x = $acum % 11;
        $acum = ($x > 1) ? (11 - $x) : 0;
        /* Retorna falso se o digito calculado eh diferente do passado na string */
        if ($acum != $cpf[10])
        {
             $err =  $this->l('N&uacutemero inválido. Verifique por favor!');
             return $err;
        }

        /* Retorna verdadeiro se o cpf � valido */
        return '1';
    }

    function cnpjValidate($str)
    {
        $nulos = array("12345678909123","11111111111111","111111111111111","22222222222222","222222222222222","33333333333333","333333333333333","44444444444444","444444444444444","55555555555555", "555555555555555","66666666666666", "666666666666666","77777777777777", "777777777777777",
            "88888888888888", "888888888888888", "99999999999999","999999999999999", "00000000000000", "000000000000000");

        if (!preg_match('|^(\d{2,3})\.?(\d{3})\.?(\d{3})\/?(\d{4})\-?(\d{2})$|', $str, $matches))
        {
            $err =  $this->l('N&uacutemero inválido. Verifique por favor!');
            return $err;
        }
        if($this->checkDuplicate('doc',$str) == true)
        {
             $err =  $this->l('Este n&uacutemero já está cadastrado!');
             return $err;
        }
        if (in_array($str, $nulos))
        {
             $err =  $this->l('N&uacutemero nulo. Verifique por favor!');
             return $err;
        }

        array_shift($matches);


        $str = implode('', $matches);
        if (strlen($str) > 14)
        $str = substr($str, 1);

        $sum1 = 0;
        $sum2 = 0;
        $sum3 = 0;
        $calc1 = 5;
        $calc2 = 6;

        for ($i=0; $i <= 12; $i++)
        {
            $calc1 = $calc1 < 2 ? 9 : $calc1;
            $calc2 = $calc2 < 2 ? 9 : $calc2;

            if ($i <= 11)
            $sum1 += $str[$i] * $calc1;

            $sum2 += $str[$i] * $calc2;
            $sum3 += $str[$i];
            $calc1--;
            $calc2--;
        }

        $sum1 %= 11;
        $sum2 %= 11;

        $result = ($sum3 && $str[12] == ($sum1 < 2 ? 0 : 11 - $sum1) && $str[13] == ($sum2 < 2 ? 0 : 11 - $sum2)) ? true : false;

        if(!$result)
        {
            $err =  $this->l('N&uacutemero inválido. Verifique por favor!');
            return $err;
        }
        return '1';
    }

    public function getDoc($id_customer)
	{
		if(!$query = Db::getInstance()->getRow('
		SELECT * FROM `'._DB_PREFIX_.'cpfmodule_data`
		WHERE `id_customer` = "'.pSQL($id_customer).'"'))
        return false;
        $doc->number = $query['doc'];
        $doc->type = $query['type'];
        $doc->idt = $query['idt'];
        return $doc;
	}

    public function checkDuplicate($field,$value)
	{
		$db = Db::getInstance();
		$result = $db->getRow('
		SELECT * FROM `'._DB_PREFIX_.'cpfmodule_data`
		WHERE `'.$field.'` = "'.$value.'"');

		return intval($result[$field]) != 0 ? true : false;
	}

    public function obterLogradouroAuth($cep, $username, $password)
    {
        $url = "http://www.byjg.com.br/site/webservice.php/ws/cep?httpmethod=obterlogradouroauth";
        $url .=	"&cep=" . urlencode($cep);
        $url .=	"&usuario=" . urlencode($username);
        $url .=	"&senha=" . urlencode($password);
        $result = file_get_contents($url);
        return $result;
    }


    private function autoCepGet($cep)
    {
        $url      = ('http://www.autocep.com.br/webcep/wsEndereco.asmx?WSDL');

        $soap = new SoapClient($url);
        $return = $soap->AutenticaClienteXml(array(
          'idCliente'   => $this->autoCepUser,
          'chave'    => $this->autoCepKey,
          'CEP'  => $cep,
        )
      );

      $obj =  (array)$return->AutenticaClienteXmlResult;
      $xml =  new SimpleXMLElement($obj['any']);
      return $xml;
    }

    public function getAddress($cep_nb)
    {
        $webservice = $this->webservice;
        $cep = preg_replace("/[^0-9]/", "", $cep_nb);

        if(strlen($cep) <> 8)
        {
            $return ='
            var resultadoCEP = {
            "uf" 		: "",
                    "cidade" 		: "",
            "bairro" 		: "",
            "tipo_logradouro" 	: "",
            "logradouro" 		: "",
            "resultado" 		: "0"
            } ';

            return $return;
        }

        switch($webservice)
        {
            case "BYJG":
            {
                $result = $this->obterLogradouroAuth($cep,$this->byjgUser,$this->byjgPwd);
                $aux = str_replace('|',':',str_replace(',',':',$result)) ;
                $aux = explode(":", $aux);

                if (array_key_exists('2', $aux))
                {
                    if(strstr($aux[1],'-') == true)
                    {
                        $log = explode("-", $aux[1]);
                        $logr = explode(" ", trim($log[0]));
                        $logradouro = trim(substr($log[0],strlen($logr[0])));
                    }
                    else $logradouro = trim($log[1]);

                    $return ='
                    var resultadoCEP = {
                    "uf" 			: "'.trim($aux[4]).'",
                    "cidade" 		: "'.trim($aux[3]).'",
                    "bairro" 		: "'.trim($aux[2]).'",
                    "tipo_logradouro" 	: "'.$logr[0].'",
                    "logradouro" 		: "'.$logradouro.'",
                    "resultado" 		:"1"
                    } ';

                    return $return;
                }
                else
                {
                    $return ='
                    var resultadoCEP = {
                    "uf" 			: "",
                    "cidade" 		: "",
                    "bairro" 		: "",
                    "tipo_logradouro" 	: "",
                    "logradouro" 		: "",
                    "resultado" 		: "0"
                    } ';

                    return $return;
                }
                break;
            }
            case "RV":
            {
                $url = 'http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep='.$cep;
                $result = file_get_contents($url);
                return $result;
                break;
            }
            case "CL":
            {
                $cep = substr($cep, 0, -3).'-'. substr($cep, -3);
                $url = 'http://ceplivre.pc2consultoria.com/index.php?module=cep&format=xml&cep='.$cep;
                $xml = simplexml_load_file($url);

                if(strcmp(strval($xml->cep->sucesso), '1') == 0)
                {
                    $return = '
                    var resultadoCEP = {
                    "uf" 			: "'.$xml->cep->estado_sigla.'",
                    "cidade" 		: "'.$xml->cep->cidade.'",
                    "bairro" 		: "'.$xml->cep->bairro.'",
                    "tipo_logradouro" 	: "'.$xml->cep->tipo_logradouro.'",
                    "logradouro" 		: "'.$xml->cep->logradouro.'",
                    "resultado" 		: "1"
                    } ';

                    return $return;
                }
                else
                {
                    $return = '
                    var resultadoCEP = {
                    "uf" 			: "",
                    "cidade" 		: "",
                    "bairro" 		: "",
                    "tipo_logradouro" 	: "",
                    "logradouro" 		: "",
                    "resultado" 		: "0"
                    } ';

                    return $return;
                }
                break;
            }
            case "MV":
            {
                $url = 'http://www.midiaville.com.br/webservices/index.php?cep='.$cep;
                $xml = simplexml_load_file($url);

                if(strcmp(strval($xml->achou), 'S') == 0)
                {
                    $return = '
                    var resultadoCEP = {
                    "uf" 			: "'.($xml->uf).'",
                    "cidade" 		: "'.ucwords(strtolower($xml->localidade)).'",
                    "bairro" 		: "'.ucwords(strtolower($xml->bairro)).'",
                    "tipo_logradouro" 	: "Rua/Av.",
                    "logradouro" 		: "'.ucwords(strtolower($xml->logradouro)).'",
                    "resultado" 		: "1"
                    } ';

                    return $return;
                }
                else
                {
                    $return ='
                    var resultadoCEP = {
                    "uf" 			: "",
                    "cidade" 		: "",
                    "bairro" 		: "",
                    "tipo_logradouro" 	: "",
                    "logradouro" 		: "",
                    "resultado" 		: "0"
                    } ';

                    return $return;
                }
                break;
            }
            case "BC":
            {
                $key = $this->bcKey;
                $url = 'http://www.buscarcep.com.br/?cep='.$cep.'&formato=xml&chave='.$key.'';
                $xml = simplexml_load_file($url);

                if(strcmp(strval($xml->retorno->resultado), '1') == 0)
                {
                    $return ='
                    var resultadoCEP = {
                    "uf" 			: "'.$xml->retorno->uf.'",
                    "cidade" 		: "'.$xml->retorno->cidade.'",
                    "bairro" 		: "'.$xml->retorno->bairro.'",
                    "tipo_logradouro" 	: "'.$xml->retorno->tipo_logradouro.'",
                    "logradouro" 		: "'.$xml->retorno->logradouro.'",
                    "resultado" 		: "'.$xml->retorno->resultado.'"
                    } ';

                    return $return;
                }
                else
                {
                    $return ='
                    var resultadoCEP = {
                    "uf" 			: "",
                    "cidade" 		: "",
                    "tipo_logradouro" 	: "",
                    "logradouro" 		: "",
                    "resultado" 		: "0"
                    } ';

                    return $return;
                }
                break;
            }
            case "AC":
            {
                $xml = $this->autoCepGet($cep);

                if (strcmp((string)$xml->EnderecoCEP->IDRESULTADO,'002') == 0)
                {
                    $return ='
                    var resultadoCEP = {
                    "uf" 			: "'.(string)$xml->EnderecoCEP->UF.'",
                    "cidade" 		: "'.ucwords(strtolower((string)$xml->EnderecoCEP->CIDADE)).'",
                    "bairro" 		: "'.ucwords(strtolower((string)$xml->EnderecoCEP->BAIRRO1)).'",
                    "tipo_logradouro" : "'.ucwords(strtolower((string)$xml->EnderecoCEP->TIPO)).'",
                    "logradouro" 	: "'.ucwords(strtolower((string)$xml->EnderecoCEP->NOME)).'",
                    "resultado" 		:"1"
                    } ';

                    return $return;
                }
                else
                {
                    $return ='
                    var resultadoCEP = {
                    "uf" 			: "",
                    "cidade" 		: "",
                    "bairro" 		: "",
                    "tipo_logradouro" 	: "",
                    "logradouro" 		: "",
                    "resultado" 		: "0"
                    } ';

                    return $return;
                }
                break;
            }
        }
    }
    
    public function getLanguages()
    {
        $languages = Language::getLanguages(true);
        foreach($languages as $key => $lang)
        {
            $result[$lang['id_lang']] = 'CpfModule';
        }

        return $result;
    }

    public function installModuleTab()
    {
        $this->smartCopy(_PS_MODULE_DIR_.$this->name.'/logo.gif', _PS_IMG_DIR_.'t/AdminCpfModule.gif');
        $tab = new Tab();
        $tab->name = $this->getLanguages();
        $tab->class_name = 'AdminCpfModule';
        $tab->module = $this->name;
        $tab->id_parent = '2';
        if(!$tab->save())
        return false;
        return true;
    }

    private function uninstallModuleTab()
    {
        $idTab = Tab::getIdFromClassName('AdminCpfModule');
        if($idTab != 0)
        {
            $tab = new Tab($idTab);
            $tab->delete();

            return true;
        }
        return false;
    }
    
    private function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755))
    {
        $result=false;

        if (is_file($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if (!file_exists($dest)) {
                    cmfcDirectory::makeAll($dest,$options['folderPermission'],true);
                }
                $__dest=$dest."/".basename($source);
            } else {
                $__dest=$dest;
            }
            $result=copy($source, $__dest);
            chmod($__dest,$options['filePermission']);

        } elseif(is_dir($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if ($source[strlen($source)-1]=='/') {
                    //Copy only contents
                } else {
                    //Change parent itself and its contents
                    $dest=$dest.basename($source);
                    @mkdir($dest);
                    chmod($dest,$options['filePermission']);
                }
            } else {
                if ($source[strlen($source)-1]=='/') {
                    //Copy parent directory with new name and all its content
                     @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                } else {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                }
            }

            $dirHandle=opendir($source);
            while($file=readdir($dirHandle))
            {
                if($file!="." && $file!="..")
                {
                     if(!is_dir($source."/".$file)) {
                        $__dest=$dest."/".$file;
                    } else {
                        $__dest=$dest."/".$file;
                    }
                    //echo "$source/$file ||| $__dest<br />";
                    $result=smartCopy($source."/".$file, $__dest, $options);
                }
            }
            closedir($dirHandle);

        } else {
            $result=false;
        }
        return $result;
    }

    public function doPaginationLinks()
    {
        $customers = (Customer::getCustomers());
        $nbPages   = ceil(count($customers)/$this->qtyPerPage);
        $return = '
        <table class="table"><tr><th>'.$this->l('Pagination:').'</th>';
        for($i = 1; $i <= $nbPages ; $i++)
        {
            $return .= '<td><a id="'.$i.'" name="page" href="javascript:void(0);" onClick="sendRequest('.$i.'); return false;">['.$i.']</a></td>';
        }
        $return .= '<th id="update">*</th></tr></table>';
        
        return $return;
    }

    public function getCustomers($page)
    {
        $customers  =  Db::getInstance()->ExecuteS('
                	   SELECT `id_customer`, `email`, `firstname`, `lastname`
                       FROM `'._DB_PREFIX_.'customer`
                       ORDER BY `id_customer` ASC
                       LIMIT '.(ceil($page * $this->qtyPerPage)).', '.$this->qtyPerPage.' ');
        $return = '
        <table class="table" width="900" cellpadding="0" cellspacing="2" id="form">
          <tr>
              <th>'.$this->l('Customer Id').'</th><th>'.$this->l('Name').'</th><th>'.$this->l('Document').'</th><th>'.$this->l('Number').'</th><th>'.$this->l('Identification Number').'</th>
          </tr>';

        foreach($customers as $k => $v)
        {
            $r = $this->getDoc($v['id_customer']);
            if (!$r) {$r->type = 'N/C'; $r->number = 'N/C'; $r->idt = 'N/C';}

            $return .= '
              <tr>
                  <td>'.$v['id_customer'].'</td>
                  <td>'.ucfirst(strtolower($v['firstname'])).' '.ucfirst(strtolower($v['lastname'])).'</td>
                  <td>'.Tools:: strtoupper($r->type).'</td>
                  <td>'.$r->number.'</td>
                  <td>'.(!empty($r->idt) ? $r->idt : 'N/C').'</td>

              </tr> ';
        }

        $return .= '       </table> ';
        return $return;
    }
    
    public function getAddressToModule($cep_nb)
    {
        @ini_set('allow_url_fopen', 1);

        $webservice = $this->webservice;
        $cep = preg_replace("/[^0-9]/", "", $cep_nb);

        if(strlen($cep) <> 8)
        {
            $return = false;

            return $return;
        }

        switch($webservice)
        {
            case "BYJG":
            {
                $result = $this->obterLogradouroAuth($cep,$this->byjgUser,$this->byjgPwd);
                $aux = str_replace('|',':',str_replace(',',':',$result)) ;
                $aux = explode(":", $aux);

                if (array_key_exists('2', $aux))
                {
                    if(strstr($aux[1],'-') == true)
                    {
                        $log = explode("-", $aux[1]);
                        $logr = explode(" ", trim($log[0]));
                        $logradouro = trim(substr($log[0],strlen($logr[0])));
                    }
                    else $logradouro = trim($aux[1]);

                    $return['uf'] = trim($aux[4]);
                    $return['cidade'] = trim($aux[3]);
                    $return['bairro'] = trim($aux[2]);
                    $return['tipo_logradouro'] = isset($logr) ? $logr[0] : '';
                    $return['logradouro'] = $logradouro;

                    return $return;
                }
                else
                {
                    $return = false;

                    return $return;
                }
                break;
            }
            case "RV":
            {
                $url = 'http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep='.$cep;
                $xml = simplexml_load_file($url);

                $return['uf'] = $xml->uf;
                $return['cidade'] = $xml->cidade;
                $return['bairro'] = $xml->bairro;
                $return['tipo_logradouro'] =  $xml->tipo_logradouro;
                $return['logradouro'] = $xml->logradouro;
                
                return $return;
                break;
            }
            case "CL":
            {
                $cep = substr($cep, 0, -3).'-'. substr($cep, -3);
                $url = 'http://ceplivre.pc2consultoria.com/index.php?module=cep&format=xml&cep='.$cep;
                $xml = @simplexml_load_file($url);

                if(strcmp(strval($xml->cep->sucesso), '1') == 0)
                {
                    $return['uf'] = (string)$xml->cep->estado_sigla;
                    $return['cidade'] = (string)$xml->cep->cidade;
                    $return['bairro'] = (string)$xml->cep->bairro;
                    $return['tipo_logradouro'] =  (string)$xml->cep->tipo_logradouro;
                    $return['logradouro'] = (string)$xml->cep->logradouro;

                    return $return;
                }
                else
                {
                    $return = false;
                    return $return;
                }
                break;
            }
            case "MV":
            {
                $url = 'http://www.midiaville.com.br/webservices/index.php?cep='.$cep;
                $xml = @simplexml_load_file($url);

                if(strcmp(strval($xml->achou), 'S') == 0)
                {
                    $return['uf'] = $xml->uf;
                    $return['cidade'] = ucwords(strtolower($xml->localidade));
                    $return['bairro'] = ucwords(strtolower($xml->bairro));
                    $return['tipo_logradouro'] =  "Rua/Av.";
                    $return['logradouro'] = ucwords(strtolower($xml->logradouro));

                    return $return;
                }
                else
                {
                    $return = false;

                    return $return;
                }
                break;
            }
            case "BC":
            {
                $key = $this->bcKey;
                $url = 'http://www.buscarcep.com.br/?cep='.$cep.'&formato=xml&chave='.$key.'';
                $xml = simplexml_load_file($url);

                if(strcmp(strval($xml->retorno->resultado), '1') == 0)
                {
                    $return['uf'] = $xml->retorno->uf;
                    $return['cidade'] = $xml->retorno->cidade;
                    $return['bairro'] = $xml->retorno->bairro;
                    $return['tipo_logradouro'] =  $xml->retorno->tipo_logradouro;
                    $return['logradouro'] = $xml->retorno->logradouro;

                    return $return;
                }
                else
                {
                    $return = false;

                    return $return;
                }
                break;
            }
            case "AC":
            {
                $xml = $this->autoCepGet($cep);

                if (strcmp((string)$xml->EnderecoCEP->IDRESULTADO,'002') == 0)
                {

                    $return['uf'] = (string)$xml->EnderecoCEP->UF;
                    $return['cidade'] = ucwords(strtolower((string)$xml->EnderecoCEP->CIDADE));
                    $return['bairro'] = ucwords(strtolower((string)$xml->EnderecoCEP->BAIRRO1));
                    $return['tipo_logradouro'] =  ucwords(strtolower((string)$xml->EnderecoCEP->TIPO));
                    $return['logradouro'] = ucwords(strtolower((string)$xml->EnderecoCEP->NOME));

                    return $return;
                }
                else
                {
                    $return = false;

                    return $return;
                }
                break;
            }
            default:
            {
                $url = 'http://www.midiaville.com.br/webservices/index.php?cep='.$cep;
                $xml = @simplexml_load_file($url);

                if(strcmp(strval($xml->achou), 'S') == 0)
                {
                    $return['uf'] = $xml->uf;
                    $return['cidade'] = ucwords(strtolower($xml->localidade));
                    $return['bairro'] = ucwords(strtolower($xml->bairro));
                    $return['tipo_logradouro'] =  "Rua/Av.";
                    $return['logradouro'] = ucwords(strtolower($xml->logradouro));

                    return $return;
                }
                else
                {
                    $return = false;

                    return $return;
                }                
            }
            
        }
    }

}
?>
