<?php

namespace App\Utils;

use \DrSlump\Protobuf\Message;
use App\Proto\ProtobufMessages;
use App\Proto\ProtobufMessage;

class Util
{
    /**
     *
     * @param  array|Message[] $objects
     * @return string
     * @throws \Exception
     */
    public static function serialize(array $objects)
    {
        $messages = new ProtobufMessages();
        $count = 0;
        foreach ($objects as $object) {
            if (!($object instanceof Message)) throw new \Exception("can not serializable object");
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
     * @param  string $serializedObject
     * @return array|Message[]
     * @throws \Exception
     */
    public static function deserialize($serializedObject)
    {
        $objects = [];
        $messages = ProtobufMessages::deserialize($serializedObject);
        for ($i = 0; $i < $messages->getCount(); $i++) {
            $message = $messages->getMessages($i);
            $object = ProtobufObject::typeIdToObject($message->getType());
            $object = $object->deserialize($message->getPayload());
            $objects[] = $object;
        }
        return $objects;
    }

    /**
     * @param  int $total
     * @param  int $size
     * @param  int $places
     * @return array
     */
    public static function randomValueArray(int $total, int $size, int $places = 0): array
    {
        $base = round($total / $size, $places);

        $values = array_fill(0, $size, $base);

        for ($i = 0; $i < $size; $i += 2) {
            $diff = round((rand() / getrandmax()) * $base, $places);
            $values[$i] += $diff;
            $values[$i + 1] -= $diff;
        }

        return $values;
    }
}
