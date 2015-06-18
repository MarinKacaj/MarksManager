<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 3:34 PM
 */

namespace fti\adv_db\property;


use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class IntegerProperty
 * @package fti\adv_db\property
 */
class IntegerProperty extends BasicProperty
{

    /**
     * @var int
     */
    protected $value;

    /**
     * @param string $name
     * @param string $label
     * @param int $value
     * @param bool $showOnForm
     * @param bool $showOnList
     */
    function __construct($name, $label, $value, $showOnForm, $showOnList)
    {
        parent::__construct($name, $name, BasicProperty::INTEGER, $label, $showOnForm, $showOnList);
        $this->value = intval($value);
    }

    /**
     * @param FormViewGenerator $formViewGenerator
     * @param string $name
     */
    public function buildFormBlock($formViewGenerator, $name)
    {
        $formViewGenerator->appendNumberInputBlock(
            $this->label,
            $this->value,
            $name
        );
    }

    /**
     * @param DetailViewGenerator $detailViewGenerator
     * @param string $name
     */
    public function buildDetailBlock($detailViewGenerator, $name)
    {
        // TODO: Implement buildDetailBlock() method.
    }


}