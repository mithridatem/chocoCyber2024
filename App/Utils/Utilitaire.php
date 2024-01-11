<?php
namespace App\Utils;
class Utilitaire{
    public static function cleanInput(?string $value):?string{
        return htmlspecialchars(strip_tags(trim($value)),ENT_NOQUOTES);
    }
    public static function getFileExtension($file){
        return substr(strrchr($file,'.'),1);
    }
}
