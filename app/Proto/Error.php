<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin @package_version@
// Source: Error.proto

namespace App\Proto {

  class Error extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $code = null;
    
    /**  @var string */
    public $message = null;
    
    /**  @var string */
    public $id = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'App.Proto.Error');

      // REQUIRED UINT32 code = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "code";
      $f->type      = \DrSlump\Protobuf::TYPE_UINT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REQUIRED STRING message = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "message";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REQUIRED STRING id = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "id";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <code> has a value
     *
     * @return boolean
     */
    public function hasCode(){
      return $this->_has(1);
    }
    
    /**
     * Clear <code> value
     *
     * @return \App\Proto\Error
     */
    public function clearCode(){
      return $this->_clear(1);
    }
    
    /**
     * Get <code> value
     *
     * @return int
     */
    public function getCode(){
      return $this->_get(1);
    }
    
    /**
     * Set <code> value
     *
     * @param int $value
     * @return \App\Proto\Error
     */
    public function setCode( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <message> has a value
     *
     * @return boolean
     */
    public function hasMessage(){
      return $this->_has(2);
    }
    
    /**
     * Clear <message> value
     *
     * @return \App\Proto\Error
     */
    public function clearMessage(){
      return $this->_clear(2);
    }
    
    /**
     * Get <message> value
     *
     * @return string
     */
    public function getMessage(){
      return $this->_get(2);
    }
    
    /**
     * Set <message> value
     *
     * @param string $value
     * @return \App\Proto\Error
     */
    public function setMessage( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <id> has a value
     *
     * @return boolean
     */
    public function hasId(){
      return $this->_has(3);
    }
    
    /**
     * Clear <id> value
     *
     * @return \App\Proto\Error
     */
    public function clearId(){
      return $this->_clear(3);
    }
    
    /**
     * Get <id> value
     *
     * @return string
     */
    public function getId(){
      return $this->_get(3);
    }
    
    /**
     * Set <id> value
     *
     * @param string $value
     * @return \App\Proto\Error
     */
    public function setId( $value){
      return $this->_set(3, $value);
    }
  }
}

