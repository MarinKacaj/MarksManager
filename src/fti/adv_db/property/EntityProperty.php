<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/11/2015
 * Time: 12:12 PM
 */

namespace fti\adv_db\property;


use DOMElement;
use fti\adv_db\entity\BasicEntity;
use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;
use fti\adv_db\view\ListViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class EntityProperty
 * @package fti\adv_db\property
 */
class EntityProperty extends BasicProperty
{

    /**
     * @var int
     */
    protected $value;
    /**
     * @var BasicEntity[]
     */
    private $entityInstances;

    /**
     * @param string $name
     * @param string $label
     * @param int $value
     * @param BasicEntity[] $entityInstances
     * @param bool $show
     */
    function __construct($name, $label, $value, $entityInstances, $show)
    {
        parent::__construct($name, $name, BasicProperty::ENTITY, $label, $show);

        $this->value = $value;
        $this->entityInstances = $entityInstances;
    }


    /**
     * @return BasicEntity
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param BasicEntity $value
     * @return void
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
        $valueTextPairs = array();
        $entityInstances = $this->entityInstances;

        foreach ($entityInstances as $entityInstance) {
            $value = $entityInstance->getId();
            $text = $entityInstance->getDisplayName();
            $valueTextPairs[$value] = $text;
        }
        unset($entityInstance);

        $formViewGenerator->appendSelectBlock($this->label, $name, $valueTextPairs);
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