<?php
echo '<?php';

/**
 * @param string 型名
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

// fencer-protocol から proto ファイルの一覧を取得する
$typeNames = [];
searchProto($typeNames, $argv[1] . '/proto');
?>

namespace App\Utils;

use \DrSlump\Protobuf\Message;
use App\Exceptions\IllegalTypeObjectException;
<?php
foreach ($typeNames as $typeName) {
    echo "use App\\Models\\$typeName;\n";
}
?>

/**
* シリアライズ・デシリアライズ時に参照する型テーブル変換ユーティリティ。
*/
class TypeTableUtil
{
/**
* モデルデータから型IDを取得します。
*
* @param  Message $object モデルデータ
* @return int             型ID
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
throw new IllegalTypeObjectException("unknown object type");
}

/**
* 型IDからモデルデータを取得します。
*
* @param  int     $typeId 型ID
* @return Message         モデルデータ
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
throw new IllegalTypeObjectException("unknown type id");
}
}

<?php
exit(0);
?>
