<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Doctrine\Inflector\InflectorFactory;

class Helper
{
    public static function flattenArray($array) {
        $flatArray = [];
        foreach ($array as $value) {
            if (is_array($value)) {
                $flatArray = array_merge($flatArray, self::flattenArray($value));
            } else {
                $flatArray[] = $value;
            }
        }
        return $flatArray;
    }

    public static function findKeyByValue(array $array, $searchValue)
    {
        foreach ($array as $key => $values) {
            if (is_array($values)) {
                if (in_array($searchValue, $values)) {
                    return $key;
                } else {
                    $found = self::findKeyByValue($values, $searchValue);
                    if ($found) {
                        return $found;
                    }
                }
            }
        }
        return null; // Return null if the value is not found
    }
    public static function singularize($word)
    {
        $inflector = InflectorFactory::create()->build();
        $a = $inflector->singularize($word);
        return $a;

    }
}