<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 11:09 PM
 */

namespace fti\adv_db\property;


use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class BooleanProperty
 * @package fti\adv_db\property
 */
class BooleanProperty extends BasicProperty
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $name
     * @param string $label
     * @param array $params
     * @param string $paramName
     * @param bool $showOnForm
     * @param bool $showOnList
     */
    function __construct($name, $label, $params, $paramName, $showOnForm, $showOnList)
    {
        parent::__construct($name, $name, BasicProperty::BOOLEAN, $label, $showOnForm, $showOnList);

        $value = false;
        if (isset($params[$paramName])) {
            if (strcmp($params[$paramName], 'on') === 0 || $params[$paramName] == 1) {
                $value = true;
            }
        }
        $this->value = $value ? '1' : '0';
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return ($this->value == '1') ? '&#10003' : '&#10007';
    }

    /**
     * @param FormViewGenerator $formViewGenerator
     * @param string $name
     */
    public function buildFormBlock($formViewGenerator, $name)
    {
        $formViewGenerator->appendCheckboxBlock(
            $this->label,
            $name,
            $this->value
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