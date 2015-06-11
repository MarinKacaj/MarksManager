<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/10/2015
 * Time: 12:57 AM
 */

namespace fti\adv_db\aggregator;

use fti\adv_db\entity\Entity;
use fti\adv_db\view\FormViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class FormViewAggregator
 * @package fti\adv_db\aggregator
 */
class FormViewAggregator extends ViewAggregator
{

    /**
     * @var FormViewGenerator
     */
    private $formViewGenerator;
    /**
     * @var Entity
     */
    protected $entityInstance;

    /**
     * @param Entity $entityInstance
     */
    function __construct($entityInstance)
    {
        $this->entityInstance = $entityInstance;

        if ($this->entityInstance->getId() === Entity::UNSAVED_INSTANCE_ID) {
            $defaultFileName = 'save.php';
        } else {
            $defaultFileName = 'update.php';
        }
        $title = $this->entityInstance->getEntityName();
        $this->formViewGenerator = new FormViewGenerator($title, $defaultFileName);
    }


    /**
     * @return string
     */
    public function buildEntityFormHTML()
    {
        $properties = $this->entityInstance->getProperties();
        foreach ($properties as $property) {
            $property->buildFormBlock($this->formViewGenerator, $property->getColName());
        }
        unset($property);

        $this->formViewGenerator->appendSubmitButton('Ruaj');
        return $this->formViewGenerator->getBuiltHTML();
    }


}