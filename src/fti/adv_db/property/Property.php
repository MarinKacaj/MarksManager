<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/8/2015
 * Time: 6:38 PM
 */

namespace fti\adv_db\property;


use DOMDocument as DOMDocument;
use DOMElement;
use fti\adv_db\view\FormViewGenerator;

/**
 * Interface Property
 * @package fti\adv_db\property
 */
interface Property
{

    const INTEGER = 1;
    const FLOAT = 2;
    const STRING = 3;
    const ARRAY_LIST = 4;
    const OBJECT = 5;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return int
     */
    public function getType();

    /**
     * @return string
     */
    public function getColName();

    /**
     * @param FormViewGenerator $formViewGenerator
     * @param string $name
     * @return DOMElement
     */
    public function createFormBlock($formViewGenerator, $name);
}