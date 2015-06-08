<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/8/2015
 * Time: 6:43 PM
 */

namespace fti\adv_db\property;


use DOMDocument as DOMDocument;

/**
 * Class Integer
 * @package fti\adv_db\property
 */
class Integer implements Property
{

    /**
     * @var int
     */
    private $value;

    /**
     * @var string
     */
    private $colName;

    /**
     * @var string
     */
    private $label;

    /**
     * @param string $value
     * @param string $colName
     * @param string $label
     */
    function __construct($value, $colName, $label)
    {
        $this->value = $value;
        $this->colName = $colName;
        $this->label = $label;
    }


    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return Property::INTEGER;
    }

    /**
     * @return string
     */
    public function getColName()
    {
        return $this->colName;
    }

    /**
     * @param DOMDocument $domDocument
     * @param string $label
     * @param string $name
     * @return string
     */
    public function createHTML($domDocument, $label, $name)
    {

    }


}