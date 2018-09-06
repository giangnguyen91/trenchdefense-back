<?php
namespace App\Utils;

use \DrSlump\Protobuf\Message;
use App\Proto\Error;
use App\Proto\ProtobufMessage;
use App\Proto\ProtobufMessages;
use App\Proto\Character;
use App\Proto\HavingCharacter;
use App\Proto\Wave;
use App\Proto\WaveListResult;
use App\Proto\WaveZombie;
use App\Proto\Weapon;
use App\Proto\Zombie;

class ProtobufObject
{
    /**
    * @param Message $object
    * @return int
    * @throws \Exception
    */
    public static function objectToTypeId(Message $object)
    {
        switch(true) {
                        case $object instanceof Error: return 0x7f2f6a15;
            case $object instanceof ProtobufMessage: return 0xe5bba9f8;
            case $object instanceof ProtobufMessages: return 0xfb72b96d;
            case $object instanceof Character: return 0xee9946c8;
            case $object instanceof HavingCharacter: return 0xecb02e52;
            case $object instanceof Wave: return 0xa24d6011;
            case $object instanceof WaveListResult: return 0xb4930e0b;
            case $object instanceof WaveZombie: return 0x2e2083f;
            case $object instanceof Weapon: return 0xead53368;
            case $object instanceof Zombie: return 0x490b3246;
        }
        throw new \Exception("unknown object type");
    }

    /**
    * @param  int $typeId
    * @return Message
    * @throws \Exception
    */
    public static function typeIdToObject($typeId)
    {
        switch($typeId) {
                        case 0x7f2f6a15: return new Error();
            case 0xe5bba9f8: return new ProtobufMessage();
            case 0xfb72b96d: return new ProtobufMessages();
            case 0xee9946c8: return new Character();
            case 0xecb02e52: return new HavingCharacter();
            case 0xa24d6011: return new Wave();
            case 0xb4930e0b: return new WaveListResult();
            case 0x2e2083f: return new WaveZombie();
            case 0xead53368: return new Weapon();
            case 0x490b3246: return new Zombie();
        }
        throw new \Exception("unknown type id");
    }
}

