<?php
namespace App\Utils;

use \DrSlump\Protobuf\Message;
use App\Proto\Error;
use App\Proto\ProtobufMessage;
use App\Proto\ProtobufMessages;
use App\Proto\Weapon;

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
            case $object instanceof Weapon: return 0xead53368;
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
            case 0xead53368: return new Weapon();
        }
        throw new \Exception("unknown type id");
    }
}

