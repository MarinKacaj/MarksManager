<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/8/2015
 * Time: 9:00 PM
 */

namespace fti\adv_db\view;

use DOMDocument;
use DOMElement;
use fti\adv_db\dom\Attribute;
use fti\adv_db\dom\DefaultAttributeValues;
use fti\adv_db\dom\Element;
use fti\adv_db\dom\util\AttributeBuilder;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class ViewGenerator
 * @package fti\adv_db\view
 */
class ViewGenerator
{

    /**
     * @var DOMDocument
     */
    private $domDocument;
    /**
     * @var int
     */
    private $genericDomID;

    function __construct()
    {
        $this->domDocument = new DOMDocument('1.0', 'iso-8859-1');
        $this->genericDomID = 0;
    }

    /**
     * @param string $title
     * @return DOMElement
     */
    public function createFormContainer($title)
    {
        $formEl = $this->domDocument->createElement(Element::FORM);
        $formEl->setAttribute(Attribute::CLASS_NAME, DefaultAttributeValues::CL_HORIZONTAL_FORM);

        $titleEl = $this->domDocument->createElement(Element::DIV);
        $titleEl->textContent = $title;
        $formEl->appendChild($titleEl);

        return $formEl;
    }

    /**
     * @param string $label
     * @param string $value
     * @param string $name
     * @return DOMElement
     */
    public function createTextInputBlock($label, $value, $name)
    {
        return $this->createSimpleInputBlock($label, $value, $name, DefaultAttributeValues::TYPE_TEXT);
    }

    /**
     * @param string $label
     * @param string $value
     * @param string $name
     * @return DOMElement
     */
    public function createNumberInputBlock($label, $value, $name)
    {
        return $this->createSimpleInputBlock($label, $value, $name, DefaultAttributeValues::TYPE_NUMBER);
    }

    /**
     * @param string $label
     * @param string $value
     * @param string $name
     * @param string $type
     * @return DOMElement
     */
    private function createSimpleInputBlock($label, $value, $name, $type)
    {
        $containerEl = $this->createFieldBlockContainer();
        $id = $this->genUniqueID();

        $labelEl = $this->createLabel($label, $id);
        $containerEl->appendChild($labelEl);

        $inputEl = $this->createInput($name, $value, $type, $id);
        $containerEl->appendChild($inputEl);

        return $containerEl;
    }

    /**
     * @return DOMElement
     */
    private function createFieldBlockContainer()
    {
        $containerEl = $this->domDocument->createElement(Element::DIV);
        $containerEl->setAttribute(Attribute::CLASS_NAME, DefaultAttributeValues::CL_FORM_GROUP);
        return $containerEl;
    }

    /**
     * @return int
     */
    private function genUniqueID()
    {
        return $this->genericDomID + 1;
    }

    /**
     * @param string $label
     * @param int $id
     * @return DOMElement
     */
    private function createLabel($label, $id)
    {
        $labelEl = $this->domDocument->createElement(Element::LABEL);
        $fullClassName = AttributeBuilder::buildFullClassName(array(
            DefaultAttributeValues::CL_SMALL_SCREEN_PREFIX . DefaultAttributeValues::LABEL_WIDTH,
            DefaultAttributeValues::CL_CONTROL_LABEL
        ));
        $labelEl->setAttribute(Attribute::CLASS_NAME, $fullClassName);
        $labelEl->setAttribute(Attribute::FOR_INPUT, DefaultAttributeValues::INPUT_ID_PREFIX . $id);

        $labelText = $this->domDocument->createTextNode($label);
        $labelEl->appendChild($labelText);

        return $labelEl;
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $type
     * @param string $id
     * @return DOMElement
     */
    private function createInput($name, $value, $type, $id)
    {
        $inputEl = $this->domDocument->createElement(Element::INPUT);
        $inputEl->setAttribute(Attribute::TYPE, $type);
        $inputEl->setAttribute(Attribute::NAME, $name);
        $inputEl->setAttribute(Attribute::VALUE, $value);
        $inputEl->setAttribute(Attribute::ID, $id);
        return $inputEl;
    }

    /**
     * @return DOMDocument
     */
    public function getDOMDocument()
    {
        return $this->domDocument;
    }


}