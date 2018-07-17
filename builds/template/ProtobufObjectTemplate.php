<?php
echo '<?php';

/**
 * @param string
 * @return int
 */
function calcTypeId($typeName)
{
    return hexdec(substr(sha1($typeName), 0, 8));
}

function searchProto(&$typeNames, $dir)
{
    foreach (glob($dir . '/*') as $file) {
        if (is_file($file)) {
            $fileName = explode($dir . '/', $file)[1];
            $typeNames[] = substr($fileName, 0, strrpos($fileName, '.'));
        } else {
            searchProto($typeNames, $file);
        }
    }
}

$typeNames = [];
searchProto($typeNames, $argv[1]);
?>

namespace App\Utils;

use \DrSlump\Protobuf\Message;
<?php
foreach ($typeNames as $typeName) {
    echo "use App\\Models\\$typeName;\n";
}
?>

class TypeTableUtil
{
/**
*
* @param  Message $object
* @return int
*/
public static function objectToTypeId(Message $object)
{
switch(true) {
<?php
foreach ($typeNames as $typeName) {
    $typeId = '0x' . dechex(calcTypeId($typeName));
    echo "            case \$object instanceof $typeName: return $typeId;\n";
}
?>
}
throw new Exception("unknown object type");
}

/**
* @param  int     $typeId
* @return Message
*/
public static function typeIdToObject($typeId)
{
switch($typeId) {
<?php
foreach ($typeNames as $typeName) {
    $typeId = '0x' . dechex(calcTypeId($typeName));
    echo "            case $typeId: return new $typeName();\n";
}
?>
}
throw new Exception("unknown type id");
}
}

<?php
exit(0);
?>
