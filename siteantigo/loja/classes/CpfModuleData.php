<?php
class CpfModuleData extends ObjectModel{

   public $doc;
   	public $type;
   	public $idt ;
   	public $id_customer;
   	public $housenb;

public static $definition = array(
'table' => 'cpfmodule_data',
'primary' => 'id_customer',
'fields' => array(

  'doc' => array('type' => self::TYPE_STRING, 'required' => false, 'size' => 14),
   	 'type' => array('type' => self::TYPE_STRING,  'required' => false, 'size' => 4),
   	 'idt' => array('type' => self::TYPE_STRING,  'required' => false, 'size' => 15),
   	 'id_customer' => array('type'=> self::TYPE_INT, 'required' => false),
   	 'housenb' => array('type' => self::TYPE_STRING,  'required' => false, 'size' => 50),


),
);

}