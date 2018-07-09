<?php
namespace Codefii\Support;
class Porter
{
    public function toJson($dados, $charset = 'UTF-8')
    {
        header('Content-Type: application/json');

        if ($charset <> 'UFT-8') {
            array_walk_recursive($dados, function(&$value, $key) {
                if (is_string($value)) {
                    $value = utf8_encode(self::clean($value));
                }
            });
        }

        return json_encode($dados);
    }

    public function clean($string)
    {
        $table = array(
                '?' => 'S', '?' => 's', '?' => 'Dj', '?' => 'dj', '?' => 'Z',
                '?' => 'z', '?' => 'C', '?' => 'c', '?' => 'C', '?' => 'c',
                'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
                'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
                'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
                'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
                'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
                'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
                'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
                'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
                'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
                'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
                'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
                'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
                'ÿ' => 'y', '?' => 'R', '?' => 'r', 'ü' => 'u', 'º' => '',
                'ª' => '',
            );

        $string = strtr($string, $table);

        return $string;
    }
}
