<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin @package_version@
// Source: character/CharacterStatus.proto

namespace App\Proto {

  class CharacterStatus extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $dropGold = null;
    
    /**  @var int */
    public $hp = null;
    
    /**  @var \App\Proto\Weapon[]  */
    public $weapons = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'App.Proto.CharacterStatus');

      // REQUIRED UINT32 dropGold = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "dropGold";
      $f->type      = \DrSlump\Protobuf::TYPE_UINT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REQUIRED UINT32 hp = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "hp";
      $f->type      = \DrSlump\Protobuf::TYPE_UINT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REPEATED MESSAGE weapons = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "weapons";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\App\Proto\Weapon';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <dropGold> has a value
     *
     * @return boolean
     */
    public function hasDropGold(){
      return $this->_has(1);
    }
    
    /**
     * Clear <dropGold> value
     *
     * @return \App\Proto\CharacterStatus
     */
    public function clearDropGold(){
      return $this->_clear(1);
    }
    
    /**
     * Get <dropGold> value
     *
     * @return int
     */
    public function getDropGold(){
      return $this->_get(1);
    }
    
    /**
     * Set <dropGold> value
     *
     * @param int $value
     * @return \App\Proto\CharacterStatus
     */
    public function setDropGold( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <hp> has a value
     *
     * @return boolean
     */
    public function hasHp(){
      return $this->_has(2);
    }
    
    /**
     * Clear <hp> value
     *
     * @return \App\Proto\CharacterStatus
     */
    public function clearHp(){
      return $this->_clear(2);
    }
    
    /**
     * Get <hp> value
     *
     * @return int
     */
    public function getHp(){
      return $this->_get(2);
    }
    
    /**
     * Set <hp> value
     *
     * @param int $value
     * @return \App\Proto\CharacterStatus
     */
    public function setHp( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <weapons> has a value
     *
     * @return boolean
     */
    public function hasWeapons(){
      return $this->_has(3);
    }
    
    /**
     * Clear <weapons> value
     *
     * @return \App\Proto\CharacterStatus
     */
    public function clearWeapons(){
      return $this->_clear(3);
    }
    
    /**
     * Get <weapons> value
     *
     * @param int $idx
     * @return \App\Proto\Weapon
     */
    public function getWeapons($idx = NULL){
      return $this->_get(3, $idx);
    }
    
    /**
     * Set <weapons> value
     *
     * @param \App\Proto\Weapon $value
     * @return \App\Proto\CharacterStatus
     */
    public function setWeapons(\App\Proto\Weapon $value, $idx = NULL){
      return $this->_set(3, $value, $idx);
    }
    
    /**
     * Get all elements of <weapons>
     *
     * @return \App\Proto\Weapon[]
     */
    public function getWeaponsList(){
     return $this->_get(3);
    }
    
    /**
     * Add a new element to <weapons>
     *
     * @param \App\Proto\Weapon $value
     * @return \App\Proto\CharacterStatus
     */
    public function addWeapons(\App\Proto\Weapon $value){
     return $this->_add(3, $value);
    }
  }
}
