<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/10/2015
 * Time: 12:57 AM
 */

namespace fti\adv_db\aggregator;

use fti\adv_db\entity\BasicEntity;
use fti\adv_db\http\HttpEntityParamBuilder;
use fti\adv_db\view\FormViewGenerator;

require_once dirname(dirname(__FILE__)) . '/constants/gen_purpose.php';
require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class FormViewAggregator
 * @package fti\adv_db\aggregator
 */
class FormViewAggregator
{

    /**
     * @var FormViewGenerator
     */
    private $formViewGenerator;
    /**
     * @var BasicEntity
     */
    protected $entityInstance;

    /**
     * @param BasicEntity $entityInstance
     * @param string $extraActionArgs [optional]
     */
    function __construct($entityInstance, $extraActionArgs = '')
    {
        $this->entityInstance = $entityInstance;

        $action = HttpEntityParamBuilder::buildFormAction($entityInstance);
        if ($extraActionArgs) {
            $action .= '&' . $extraActionArgs;
        }
        $title = $this->entityInstance->getEntityName();
        $this->formViewGenerator = new FormViewGenerator($title, $action);
    }


    /**
     * @return string
     */
    public function buildEntityFormHTML()
    {
        $properties = $this->entityInstance->getProperties();
        foreach ($properties as $property) {
            if ($property->isShown()) {
                $property->buildFormBlock($this->formViewGenerator, $property->getName());
            }
        }
        unset($property);

        $this->formViewGenerator->appendSubmitButton(CREATE_BUTTON_TEXT);
        return $this->formViewGenerator->getBuiltHTML();
    }


}