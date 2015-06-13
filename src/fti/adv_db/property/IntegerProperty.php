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
use fti\adv_db\view\ListViewGenerator;

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
     * @param bool $show
     */
    function __construct($name, $label, $value, $show)
    {
        parent::__construct($name, $name, BasicProperty::INTEGER, $label, $show);
        $this->value = $value;
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

    /**
     * @param ListViewGenerator $listViewGenerator
     * @param string $name
     */
    public function buildListBlock($listViewGenerator, $name)
    {
        // TODO: Implement buildListBlock() method.
    }


}