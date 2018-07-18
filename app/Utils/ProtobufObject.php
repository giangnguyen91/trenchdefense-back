<?php
namespace App\Utils;

use \DrSlump\Protobuf\Message;
use App\Proto\Error;
use App\Proto\ProtobufMessage;
use App\Proto\ProtobufMessages;
use App\Proto\Authenticate;
use App\Proto\AuthenticateParameter;
use App\Proto\LinkSocialParameter;
use App\Proto\LinkSocialResult;
use App\Proto\Type;
use App\Proto\User;

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
            case $object instanceof Authenticate: return 0x94a019d4;
            case $object instanceof AuthenticateParameter: return 0xcdcb779f;
            case $object instanceof LinkSocialParameter: return 0x46a202c4;
            case $object instanceof LinkSocialResult: return 0xee66a1ad;
            case $object instanceof Type: return 0x3deb7456;
            case $object instanceof User: return 0x9f8a2389;
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
            case 0x94a019d4: return new Authenticate();
            case 0xcdcb779f: return new AuthenticateParameter();
            case 0x46a202c4: return new LinkSocialParameter();
            case 0xee66a1ad: return new LinkSocialResult();
            case 0x3deb7456: return new Type();
            case 0x9f8a2389: return new User();
        }
        throw new \Exception("unknown type id");
    }
}

