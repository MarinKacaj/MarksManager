<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/8/2015
 * Time: 9:00 PM
 */

namespace fti\adv_db\view;

use DOMDocumentFragment;
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
class FormViewGenerator extends ViewGenerator
{

    /**
     * @var DOMElement
     */
    private $formEl;

    /**
     * @param string $title
     * @param string $action
     * @param string $method [optional]
     * @param string $encType [optional]
     */
    public function __construct($title, $action, $method = DefaultAttributeValues::METHOD_POST, $encType = DefaultAttributeValues::ENC_TYPE_URL_ENCODED)
    {
        parent::__construct();
        $this->formEl = $this->createFormBlock($title, $action, $method, $encType);
    }


    /**
     * @return DOMElement
     */
    public function getFormElement()
    {
        return $this->formEl;
    }

    /**
     * @param DOMElement $fieldBlock
     */
    public function appendToForm($fieldBlock)
    {
        $this->formEl->appendChild($fieldBlock);
    }

    /**
     * @param string $title
     * @param $action
     * @param string $method
     * @param string $encType
     * @return DOMElement
     */
    public function createFormBlock($title, $action, $method, $encType)
    {
        $formEl = $this->domDocument->createElement(Element::FORM);
        $formEl->setAttribute(Attribute::CLASS_NAME, DefaultAttributeValues::CL_HORIZONTAL_FORM);
        $formEl->setAttribute(Attribute::ACTION, $action);
        $formEl->setAttribute(Attribute::METHOD, $method);
        $formEl->setAttribute(Attribute::ENC_TYPE, $encType);

        $titleEl = $this->domDocument->createElement(Element::DIV);
        $titleEl->textContent = $title;
        $formEl->appendChild($titleEl);

        return $formEl;
    }

    /**
     * @param string $text
     */
    public function appendSubmitButton($text)
    {
        $submitButtonEl = $this->createSubmitButton($text);
        $this->formEl->appendChild($submitButtonEl);
    }

    /**
     * @param string $text
     * @return DOMElement
     */
    public function createSubmitButton($text)
    {
        $containerEl = $this->createFieldBlockContainer();

        $buttonWrapperEl = $this->domDocument->createElement(Element::DIV);
        $fullClassName = AttributeBuilder::buildFullClassName(array(
            DefaultAttributeValues::CL_SMALL_SCREEN_OFFSET_PREFIX . DefaultAttributeValues::LABEL_WIDTH,
            DefaultAttributeValues::CL_SMALL_SCREEN_PREFIX . DefaultAttributeValues::INPUT_WIDTH
        ));
        $buttonWrapperEl->setAttribute(Attribute::CLASS_NAME, $fullClassName);

        $buttonEl = $this->domDocument->createElement(Element::BUTTON);
        $fullClassName = AttributeBuilder::buildFullClassName(array(
            DefaultAttributeValues::CL_BUTTON,
            DefaultAttributeValues::CL_DEFAULT_BUTTON
        ));
        $buttonEl->setAttribute(Attribute::CLASS_NAME, $fullClassName);
        $buttonEl->setAttribute(Attribute::TYPE, DefaultAttributeValues::TYPE_SUBMIT);
        $buttonText = $this->domDocument->createTextNode($text);
        $buttonEl->appendChild($buttonText);
        $buttonWrapperEl->appendChild($buttonEl);

        $containerEl->appendChild($buttonWrapperEl);

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
     * @param string $label
     * @param string $value
     * @param string $name
     */
    public function appendTextInputBlock($label, $value, $name)
    {
        $textInputBlockEl = $this->createTextInputBlock($label, $value, $name);
        $this->formEl->appendChild($textInputBlockEl);
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
     * @param string $type
     * @return DOMElement
     */
    private function createSimpleInputBlock($label, $value, $name, $type)
    {
        $containerEl = $this->createFieldBlockContainer();
        $id = $this->genUniqueID();

        $labelEl = $this->createLabel($label, DefaultAttributeValues::GENERIC_ID_PREFIX . $id);
        $containerEl->appendChild($labelEl);

        $inputWrapperEl = $this->createDefaultInputFieldWrapperElement();
        $inputEl = $this->createInput($name, $value, $type, $id);
        $inputWrapperEl->appendChild($inputEl);

        $containerEl->appendChild($inputWrapperEl);

        return $containerEl;
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
        $labelEl->setAttribute(Attribute::FOR_INPUT, DefaultAttributeValues::GENERIC_ID_PREFIX . $id);

        $labelText = $this->domDocument->createTextNode($label);
        $labelEl->appendChild($labelText);

        return $labelEl;
    }

    /**
     * @return DOMElement
     */
    private function createDefaultInputFieldWrapperElement()
    {
        $inputWrapperEl = $this->domDocument->createElement(Element::DIV);
        $inputWrapperEl->setAttribute(Attribute::CLASS_NAME,
            DefaultAttributeValues::CL_SMALL_SCREEN_PREFIX . DefaultAttributeValues::INPUT_WIDTH);
        return $inputWrapperEl;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @param string $type
     * @param int $id
     * @return DOMElement
     */
    private function createInput($name, $value, $type, $id)
    {
        $inputEl = $this->domDocument->createElement(Element::INPUT);
        $inputEl->setAttribute(Attribute::TYPE, $type);
        $inputEl->setAttribute(Attribute::NAME, $name);
        if (strcasecmp($type, DefaultAttributeValues::TYPE_CHECKBOX) === 0) {
            if ($value === true) {
                $inputEl->setAttribute(Attribute::CHECKED, DefaultAttributeValues::CHECKED);
            }
        } else {
            $inputEl->setAttribute(Attribute::VALUE, $value);
        }
        $inputEl->setAttribute(Attribute::ID, DefaultAttributeValues::GENERIC_ID_PREFIX . $id);
        return $inputEl;
    }

    /**
     * @param string $label
     * @param string $value
     * @param string $name
     */
    public function appendNumberInputBlock($label, $value, $name)
    {
        $numberInputBlockEl = $this->createNumberInputBlock($label, $value, $name);
        $this->formEl->appendChild($numberInputBlockEl);
    }

    /**
     * @param string $label
     * @param int $value
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
     */
    public function appendDateInputBlock($label, $value, $name)
    {
        $dateInputBlockEl = $this->createDateInputBlock($label, $value, $name);
        $this->formEl->appendChild($dateInputBlockEl);
    }

    /**
     * @param string $label
     * @param string $value
     * @param string $name
     * @return DOMElement
     */
    public function createDateInputBlock($label, $value, $name)
    {
        $value = strtotime($value);
        $value = date('d/m/Y', $value);
        $dateInputBlock = $this->createSimpleInputBlock($label, $value, $name, DefaultAttributeValues::TYPE_TEXT);
        return $dateInputBlock;
    }

    /**
     * @param string $label
     * @param string $name
     * @param string $value
     */
    public function appendCheckboxBlock($label, $name, $value)
    {
        $checkboxBlockEl = $this->createCheckboxBlock($label, $name, $value);
        $this->formEl->appendChild($checkboxBlockEl);
    }

    /**
     * @param string $label
     * @param string $name
     * @param string $value
     * @return DOMElement
     */
    public function createCheckboxBlock($label, $name, $value)
    {
        return $this->createSimpleInputBlock($label, $value, $name, DefaultAttributeValues::TYPE_CHECKBOX);
    }

    /**
     * @param string $name
     */
    public function appendEnumSelectBlock($name)
    {
        $markSelectBlockEl = $this->createEnumSelectBlock($name);
        $this->formEl->appendChild($markSelectBlockEl);
    }

    /**
     * @param string $name
     * @return DOMElement
     */
    public function createEnumSelectBlock($name)
    {
        $label = 'Result';
        $allowedMarks = array(
            DefaultAttributeValues::STUDENT_NOT_PRESENT => 'Absent',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10'
        );
        $markSelectBlock = $this->createSelectBlock($label, $name, $allowedMarks);
        return $markSelectBlock;
    }

    /**
     * @param string $label
     * @param string $name
     * @param string[] $valueTextPairs
     */
    public function appendSelectBlock($label, $name, $valueTextPairs)
    {
        $selectBlockEl = $this->createSelectBlock($label, $name, $valueTextPairs);
        $this->formEl->appendChild($selectBlockEl);
    }

    /**
     * @param string $label
     * @param string $name
     * @param string[] $valueTextPairs
     * @return DOMElement
     */
    public function createSelectBlock($label, $name, $valueTextPairs)
    {
        $containerEl = $this->createFieldBlockContainer();
        $id = $this->genUniqueID();

        $labelEl = $this->createLabel($label, $id);
        $containerEl->appendChild($labelEl);

        $selectWrapperEl = $this->createDefaultInputFieldWrapperElement();
        $selectEl = $this->createSelectElement($name, $id);
        $selectEl->setAttribute(Attribute::ID, $id);

        $optionsFragment = $this->createOptionsFragment($valueTextPairs);
        $selectEl->appendChild($optionsFragment);
        $selectWrapperEl->appendChild($selectEl);
        $containerEl->appendChild($selectWrapperEl);

        return $containerEl;
    }

    /**
     * @param string $name
     * @param int $id
     * @return DOMElement
     */
    private function createSelectElement($name, $id)
    {
        $selectEl = $this->domDocument->createElement(Element::SELECT);
        $selectEl->setAttribute(Attribute::ID, DefaultAttributeValues::GENERIC_ID_PREFIX . $id);
        $selectEl->setAttribute(Attribute::NAME, $name);
        return $selectEl;
    }

    /**
     * @param array $valueTextPairs
     * @return DOMDocumentFragment
     */
    private function createOptionsFragment($valueTextPairs)
    {
        $optionsFragment = $this->domDocument->createDocumentFragment();
        $valueTextPairs[''] = '';

        foreach ($valueTextPairs as $value => $text) {
            $optionEl = $this->createOptionElement($value, $text);
            $optionsFragment->appendChild($optionEl);
        }
        unset($value);
        unset($text);

        return $optionsFragment;
    }

    /**
     * @param string $value
     * @param string $text
     * @return DOMElement
     */
    private function createOptionElement($value, $text)
    {
        $optionEl = $this->domDocument->createElement(Element::OPTION);
        $optionEl->setAttribute(Attribute::VALUE, $value);

        $optionText = $this->domDocument->createTextNode($text);
        $optionEl->appendChild($optionText);

        return $optionEl;
    }

    /**
     * @return string
     */
    public function getBuiltHTML()
    {
        $this->domDocument->appendChild($this->formEl);
        $rawHTML = $this->domDocument->saveHTML();
        $decodedHTML = html_entity_decode($rawHTML);
        return $decodedHTML;
    }


}