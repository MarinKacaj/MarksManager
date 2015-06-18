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
    protected $value;

    /**
     * @param string $name
     * @param string $label
     * @param string $value
     * @param bool $showOnForm
     * @param bool $showOnList
     */
    function __construct($name, $label, $value, $showOnForm, $showOnList)
    {
        parent::__construct($name, $name, BasicProperty::STRING, $label, $showOnForm, $showOnList);
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


}