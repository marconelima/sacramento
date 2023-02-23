<?php  class Address extends AddressCore{
	/** @var string numero first line */
	public $numero;

    /** @var datetime date of delivery*/
    public $delivery_date;

    /** @var string complemente for adress*/
    public $complemento;   
 
    private $new_fields = array();
     public  function __construct($id_address = NULL, $id_lang = NULL){
        $this->nd_addField('numero', parent::TYPE_STRING, 'isGenericName', null, true);
        $this->nd_addField('delivery_date',parent::TYPE_STRING,'isGenericName',null,false);
        $this->nd_addField('complemento',parent::TYPE_STRING,'isGenericName',null,true);     
 
        //nao mexer a partir daqui
        $this->nd_addNewFields();
        parent::__construct($id_address);
    }
 
    private function nd_addNewFields(){
        if(!empty($this->new_fields)){
            foreach($this->new_fields as $name=>$def){
                $this->$name = '';
                parent::$definition['fields'][$name] = $def;
            }
        }
    }
 
    private function nd_addField($fieldname, $type, $validate, $size=null, $required=false){
        $this->new_fields[$fieldname] = array(
            'type' => $type,
            'validate' => $validate,
            'required' => $required,
            'size' => $size
        );
    }
}
