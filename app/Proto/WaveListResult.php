<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin @package_version@
// Source: wave/WaveListResult.proto

namespace App\Proto {

  class WaveListResult extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $totalPage = null;
    
    /**  @var \App\Proto\Wave[]  */
    public $waves = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'App.Proto.WaveListResult');

      // REQUIRED UINT32 totalPage = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "totalPage";
      $f->type      = \DrSlump\Protobuf::TYPE_UINT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REPEATED MESSAGE waves = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "waves";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\App\Proto\Wave';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <totalPage> has a value
     *
     * @return boolean
     */
    public function hasTotalPage(){
      return $this->_has(1);
    }
    
    /**
     * Clear <totalPage> value
     *
     * @return \App\Proto\WaveListResult
     */
    public function clearTotalPage(){
      return $this->_clear(1);
    }
    
    /**
     * Get <totalPage> value
     *
     * @return int
     */
    public function getTotalPage(){
      return $this->_get(1);
    }
    
    /**
     * Set <totalPage> value
     *
     * @param int $value
     * @return \App\Proto\WaveListResult
     */
    public function setTotalPage( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <waves> has a value
     *
     * @return boolean
     */
    public function hasWaves(){
      return $this->_has(2);
    }
    
    /**
     * Clear <waves> value
     *
     * @return \App\Proto\WaveListResult
     */
    public function clearWaves(){
      return $this->_clear(2);
    }
    
    /**
     * Get <waves> value
     *
     * @param int $idx
     * @return \App\Proto\Wave
     */
    public function getWaves($idx = NULL){
      return $this->_get(2, $idx);
    }
    
    /**
     * Set <waves> value
     *
     * @param \App\Proto\Wave $value
     * @return \App\Proto\WaveListResult
     */
    public function setWaves(\App\Proto\Wave $value, $idx = NULL){
      return $this->_set(2, $value, $idx);
    }
    
    /**
     * Get all elements of <waves>
     *
     * @return \App\Proto\Wave[]
     */
    public function getWavesList(){
     return $this->_get(2);
    }
    
    /**
     * Add a new element to <waves>
     *
     * @param \App\Proto\Wave $value
     * @return \App\Proto\WaveListResult
     */
    public function addWaves(\App\Proto\Wave $value){
     return $this->_add(2, $value);
    }
  }
}

