<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 3:38 PM
 */

namespace fti\adv_db\db\util;


require_once dirname(dirname(dirname(__FILE__))) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class QueryPartsBuilder
 * @package fti\adv_db\db\util
 */
class QueryPartsBuilder
{

    /**
     * @param string[] $values
     * @return string
     */
    public static function buildCSVString($values)
    {
        $csvString = '';
        $prependComma = false;

        foreach ($values as $value) {
            if ($prependComma === true) {
                $csvString .= ',' . $value;
            } else {
                $csvString .= $value;
                $prependComma = true;
            }
        }
        unset($value);

        return $csvString;
    }

    /**
     * @param string[] $nameValuePairs
     * @return array
     */
    public static function buildNameValuePairStrings($nameValuePairs)
    {
        $nameValuePairStrings = array();

        foreach ($nameValuePairs as $name => $value) {
            if (!is_numeric($value) && is_string($value)) {
                $value = "'$value'";
            }
            $nameValuePairString = $name . '=' . $value;
            array_push($nameValuePairStrings, $nameValuePairString);
        }
        unset($name);
        unset($value);

        return $nameValuePairStrings;
    }
}