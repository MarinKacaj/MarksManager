<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/8/2015
 * Time: 6:56 PM
 */

namespace fti\adv_db\dom;


use \DOMElement as DOMElement;
use \DOMText as DOMText;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class Factory
 * @package fti\adv_db\dom
 */
class Factory
{

    /**
     * @param string $label
     * @param string $value
     * @param string $id [optional]
     * @param int $min [optional]
     * @return DOMElement
     */
    public static function createNumberField($label, $value, $id = '', $min = 0)
    {
        $containerNode = new DOMElement(Element::DIV);
        $textNode = new DOMText('Hello World');
        $containerNode->appendChild($textNode);
        return $containerNode;
    }
}