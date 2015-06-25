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
    public function createListButton()
    {
        $linkEl = $this->domDocument->createElement(Element::LINK);
        $linkEl->setAttribute(Attribute::HREF, 'list.php');

        $createButtonEl = $this->domDocument->createElement(Element::BUTTON);
        $createButtonEl->setAttribute(Attribute::CLASS_NAME, 'btn btn-default');
        $buttonText = $this->domDocument->createTextNode('Kthehu te lista');
        $createButtonEl->appendChild($buttonText);
        $linkEl->appendChild($createButtonEl);

        return $linkEl;
    }

    /**
     * @return DOMElement
     */
    private function createFieldBlockContainer()
    {
        $containerEl = $this->domDocument->createElement(Element::DIV);
        $className = AttributeBuilder::buildFullClassName(array(
            DefaultAttributeValues::CL_FORM_GROUP,
            DefaultAttributeValues::CL_ROW
        ));
        $containerEl->setAttribute(Attribute::CLASS_NAME, $className);
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
     * @param int $min [optional]
     * @param int $max [optional]
     */
    public function appendNumberInputBlock($label, $value, $name, $min = -1, $max = -1)
    {
        $numberInputBlockEl = $this->createNumberInputBlock($label, $value, $name, $min, $max);
        $this->formEl->appendChild($numberInputBlockEl);
    }

    /**
     * @param string $label
     * @param int $value
     * @param string $name
     * @param int $min [optional]
     * @param int $max [optional]
     * @return DOMElement
     */
    public function createNumberInputBlock($label, $value, $name, $min = -1, $max = -1)
    {
        $containerEl = $this->createFieldBlockContainer();
        $id = $this->genUniqueID();

        $labelEl = $this->createLabel($label, DefaultAttributeValues::GENERIC_ID_PREFIX . $id);
        $containerEl->appendChild($labelEl);

        $inputWrapperEl = $this->createDefaultInputFieldWrapperElement();
        $inputEl = $this->createInput($name, $value, DefaultAttributeValues::TYPE_NUMBER, $id);
        if ($min != -1) {
            $inputEl->setAttribute(Attribute::MIN, intval($min));
        }
        if ($max != -1) {
            $inputEl->setAttribute(Attribute::MAX, intval($max));
        }
        $inputWrapperEl->appendChild($inputEl);

        $containerEl->appendChild($inputWrapperEl);

        return $containerEl;
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
        $inputContainerEl = $this->createSimpleInputBlock($label, $value, $name, DefaultAttributeValues::TYPE_TEXT);
        $currentClassName = $inputContainerEl->getAttribute(Attribute::CLASS_NAME);
        $fullClassName = AttributeBuilder::buildFullClassName(array(
            $currentClassName,
            DefaultAttributeValues::CL_DATE_TIME_PICKER
        ));
        $inputContainerEl->setAttribute(Attribute::CLASS_NAME, $fullClassName);
        return $inputContainerEl;
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
        $containerEl = $this->createFieldBlockContainer();
        $id = $this->genUniqueID();

        $labelEl = $this->createLabel($label, DefaultAttributeValues::GENERIC_ID_PREFIX . $id);
        $containerEl->appendChild($labelEl);

        $inputWrapperEl = $this->createDefaultInputFieldWrapperElement();
        $inputEl = $this->createInput($name, $value, DefaultAttributeValues::TYPE_CHECKBOX, $id);
        if ($value == 1) {
            $inputEl->setAttribute(Attribute::CHECKED, DefaultAttributeValues::CHECKED);
        }
        $inputWrapperEl->appendChild($inputEl);

        $containerEl->appendChild($inputWrapperEl);

        return $containerEl;
    }

    /**
     * @param string $label
     * @param string $name
     * @param string[] $valueTextPairs
     * @param int $value
     */
    public function appendSelectBlock($label, $name, $valueTextPairs, $value)
    {
        $selectBlockEl = $this->createSelectBlock($label, $name, $valueTextPairs, $value);
        $this->formEl->appendChild($selectBlockEl);
    }

    /**
     * @param string $label
     * @param string $name
     * @param string[] $valueTextPairs
     * @param int $value
     * @return DOMElement
     */
    public function createSelectBlock($label, $name, $valueTextPairs, $value)
    {
        $containerEl = $this->createFieldBlockContainer();
        $id = $this->genUniqueID();

        $labelEl = $this->createLabel($label, $id);
        $containerEl->appendChild($labelEl);

        $selectWrapperEl = $this->createDefaultInputFieldWrapperElement();
        $selectEl = $this->createSelectElement($name, $id);
        $selectEl->setAttribute(Attribute::ID, $id);

        $optionsFragment = $this->createOptionsFragment($valueTextPairs, $value);
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
     * @param int $selectedValue
     * @return DOMDocumentFragment
     */
    private function createOptionsFragment($valueTextPairs, $selectedValue)
    {
        $optionsFragment = $this->domDocument->createDocumentFragment();
        if (empty($valueTextPairs)) {
            $valueTextPairs[''] = '';
        }

        foreach ($valueTextPairs as $value => $text) {
            $optionEl = $this->createOptionElement($value, $text);
            if (intval($selectedValue) === intval($value)) {
                $optionEl->setAttribute(Attribute::SELECTED, DefaultAttributeValues::SELECTED);
            }
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
     * @param bool $appendListButton [optional]
     * @return string
     */
    public function getBuiltHTML($appendListButton = true)
    {
        $this->domDocument->appendChild($this->formEl);
        if ($appendListButton) {
            $listButtonEl = $this->createListButton();
            $this->domDocument->appendChild($listButtonEl);
        }
        $rawHTML = $this->domDocument->saveHTML();
        $decodedHTML = html_entity_decode($rawHTML);
        return $decodedHTML;
    }


}