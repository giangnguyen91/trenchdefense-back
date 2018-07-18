<?php
namespace App\Utils;

use \DrSlump\Protobuf\Message;
use App\Proto\ProtobufMessage;
use App\Proto\ProtobufMessages;
use App\Proto\Authenticate;
use App\Proto\AuthenticateParameter;
use App\Proto\Type;

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
                        case $object instanceof ProtobufMessage: return 0xe5bba9f8;
            case $object instanceof ProtobufMessages: return 0xfb72b96d;
            case $object instanceof Authenticate: return 0x94a019d4;
            case $object instanceof AuthenticateParameter: return 0xcdcb779f;
            case $object instanceof Type: return 0x3deb7456;
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
                        case 0xe5bba9f8: return new ProtobufMessage();
            case 0xfb72b96d: return new ProtobufMessages();
            case 0x94a019d4: return new Authenticate();
            case 0xcdcb779f: return new AuthenticateParameter();
            case 0x3deb7456: return new Type();
        }
        throw new \Exception("unknown type id");
    }
}

