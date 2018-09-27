<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin @package_version@
// Source: match/BeginMatchParameter.proto

namespace App\Proto {

  class BeginMatchParameter extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $waveID = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'App.Proto.BeginMatchParameter');

      // REQUIRED UINT32 waveID = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "waveID";
      $f->type      = \DrSlump\Protobuf::TYPE_UINT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <waveID> has a value
     *
     * @return boolean
     */
    public function hasWaveID(){
      return $this->_has(1);
    }
    
    /**
     * Clear <waveID> value
     *
     * @return \App\Proto\BeginMatchParameter
     */
    public function clearWaveID(){
      return $this->_clear(1);
    }
    
    /**
     * Get <waveID> value
     *
     * @return int
     */
    public function getWaveID(){
      return $this->_get(1);
    }
    
    /**
     * Set <waveID> value
     *
     * @param int $value
     * @return \App\Proto\BeginMatchParameter
     */
    public function setWaveID( $value){
      return $this->_set(1, $value);
    }
  }
}

