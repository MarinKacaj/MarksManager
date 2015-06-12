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

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class StringProperty
 * @package fti\adv_db\property
 */
class StringProperty extends BasicProperty
{

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $name
     * @param string $colName
     * @param string $label
     * @param string $value
     */
    function __construct($name, $colName, $label, $value)
    {
        parent::__construct($name, $colName, BasicProperty::STRING, $label);

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
     */
    public function buildFormBlock($formViewGenerator, $name)
    {
        $formViewGenerator->appendTextInputBlock(
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
    public function buildDetailBlock($detailViewGenerator, $name)
    {
        // TODO: Implement createDetailBlock() method.
    }

    /**
     * @param ListViewGenerator $listViewGenerator
     * @param string $name
     * @return DOMElement
     */
    public function buildListBlock($listViewGenerator, $name)
    {
        // TODO: Implement createListBlock() method.
    }


}