#!/usr/bin/env bash

FENCER_PROTOCOL_HOME=$1

rm -r app/Proto
echo "NOTICE: app/Proto deleted."

sed -e "3i require_once __DIR__ . '/../../autoload.php';" vendor/stanley-cheung/protobuf-php/protoc-gen-php.php > vendor/stanley-cheung/protobuf-php/protoc-gen-php-with-composer.php

chmod 755 vendor/stanley-cheung/protobuf-php/protoc-gen-php-with-composer.php

vendor/stanley-cheung/protobuf-php/protoc-gen-php-with-composer.php \
     -Dmultifile \
     -Dnamespace=App.Proto \
     -i $FENCER_PROTOCOL_HOME \
     -o ./ \
     `find $FENCER_PROTOCOL_HOME -name *.proto`

php builds/template/ProtobufObjectTemplate.php $FENCER_PROTOCOL_HOME > app/Utils/ProtobufObject.php
find app/Proto -type f | xargs sed -i -e "/^\/\/   Date: /d"
