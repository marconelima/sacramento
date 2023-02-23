<?php  class Order extends OrderCore{
	/** @var int installmentcounts first line */
	public $installmentcounts;
	
    /** @var string id_transaction for order*/
    public $id_transaction;   
 
    private $new_fields = array();
     public  function __construct($id_order = NULL, $id_lang = NULL){
        $this->nd_addField('installmentcounts', parent::TYPE_INT, 'isGenericName', null, false);
        $this->nd_addField('id_transaction',parent::TYPE_STRING,'isGenericName',null,false);     
 
        //nao mexer a partir daqui
        $this->nd_addNewFields();
        parent::__construct($id_order);
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
