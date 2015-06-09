<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 10:28 PM
 */

namespace fti\adv_db\property;


use DOMElement;
use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;
use fti\adv_db\view\ListViewGenerator;

class ADString extends BasicProperty {

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $colName
     * @param string $label
     * @param string $value
     */
    function __construct($colName, $label, $value)
    {
        parent::__construct($colName, BasicProperty::STRING, $label);

        $this->value = $value;
    }


    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param FormViewGenerator $formViewGenerator
     * @param string $name
     * @return DOMElement
     */
    public function createFormBlock($formViewGenerator, $name)
    {
        return $formViewGenerator->createTextInputBlock(
            $this->label,
            $this->value,
            $name
        );
    }

    /**
     * @param DetailViewGenerator $detailViewGenerator
     * @param string $name
     * @return DOMElement
     */
    public function createDetailBlock($detailViewGenerator, $name)
    {
        // TODO: Implement createDetailBlock() method.
    }

    /**
     * @param ListViewGenerator $listViewGenerator
     * @param string $name
     * @return DOMElement
     */
    public function createListBlock($listViewGenerator, $name)
    {
        // TODO: Implement createListBlock() method.
    }


}