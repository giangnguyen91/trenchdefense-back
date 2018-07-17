<?php

namespace App\Utils;

use App\Exceptions\IllegalTypeObjectException;
use \DrSlump\Protobuf\Message;
use App\Models\ProbufMessages;
use App\Models\ProtobufMessage;

class Util
{
    /**
     *
     * @param  array|Message[]  $objects
     * @return string
     */
    public static function serialize(array $objects)
    {
        $messages = new ProbufMessages();
        $count = 0;
        foreach($objects as $object) {
            if(!($object instanceof Message)) throw new IllegalTypeObjectException("can not serializable object");
            $message = new ProtobufMessage();
            $typeId = ProtobufObject::objectToTypeId($object);
            $message->setType($typeId);
            $message->setPayload($object->serialize());
            $messages->addMessages($message);
            $count++;
        }
        $messages->setCount($count);
        return $messages->serialize();
    }

    /**
     *
     * @param  string $serializedObject
     * @return array|Message[]
     */
    public static function deserialize($serializedObject)
    {
        $objects = [];
        $messages = ProbufMessages::deserialize($serializedObject);
        for($i=0; $i<$messages->getCount(); $i++) {
            $message = $messages->getMessages($i);
            $object = ProtobufObject::typeIdToObject($message->getType());
            $object = $object->deserialize($message->getPayload());
            $objects[] = $object;
        }
        return $objects;
    }
}
