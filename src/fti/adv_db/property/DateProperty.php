<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/22/2015
 * Time: 11:40 PM
 */

namespace fti\adv_db\property;


use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class DateProperty
 * @package fti\adv_db\property
 */
class DateProperty extends BasicProperty
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
        parent::__construct($name, $name, BasicProperty::DATE, $label, $showOnForm, $showOnList);
        $this->value = date('Y-m-d', strtotime($value));
    }

    /**
     * @param FormViewGenerator $formViewGenerator
     * @param string $name
     */
    public function buildFormBlock($formViewGenerator, $name)
    {
        $formViewGenerator->appendDateInputBlock(
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