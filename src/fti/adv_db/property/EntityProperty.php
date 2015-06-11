<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 6/11/2015
 * Time: 12:12 PM
 */

namespace fti\adv_db\property;


use DOMElement;
use fti\adv_db\entity\Entity;
use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;
use fti\adv_db\view\ListViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

class EntityProperty extends BasicProperty
{

    /**
     * @var Entity
     */
    private $value;

    /**
     * @param string $colName
     * @param string $label
     * @param string $value
     */
    function __construct($colName, $label, $value)
    {
        parent::__construct($colName, BasicProperty::ENTITY, $label);

        $this->value = $value;
    }


    /**
     * @return Entity
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Entity $value
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
        $entityInstances = $this->value->getList();

        foreach ($entityInstances as $entityInstance)
        {
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