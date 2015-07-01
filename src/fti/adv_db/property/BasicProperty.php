<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 10:20 PM
 */

namespace fti\adv_db\property;


use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class BasicProperty
 * @package fti\adv_db\property
 */
abstract class BasicProperty implements Property
{

    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $colName;
    /**
     * @var int
     */
    protected $type;
    /**
     * @var string
     */
    protected $label;
    /**
     * @var mixed
     */
    protected $value;
    /**
     * @var bool
     */
    protected $showOnForm;
    /**
     * @var bool
     */
    protected $showOnList;

    /**
     * @param string $name
     * @param string $colName
     * @param string $type
     * @param string $label
     * @param bool $showOnForm
     * @param bool $showOnList
     */
    function __construct($name, $colName, $type, $label, $showOnForm, $showOnList)
    {
        $this->name = $name;
        $this->colName = $colName;
        $this->type = $type;
        $this->label = $label;
        $this->showOnForm = $showOnForm;
        $this->showOnList = $showOnList;
    }


    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return boolean
     */
    public function isShown()
    {
        return $this->showOnForm;
    }

    /**
     * @param boolean $show
     */
    public function setShown($show)
    {
        $this->showOnForm = $show;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColName()
    {
        return $this->colName;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return boolean
     */
    public function isShowOnForm()
    {
        return $this->showOnForm;
    }

    /**
     * @return boolean
     */
    public function isShowOnList()
    {
        return $this->showOnList;
    }

    /**
     * @param FormViewGenerator $formViewGenerator
     * @param string $name
     */
    abstract public function buildFormBlock($formViewGenerator, $name);

    /**
     * @param DetailViewGenerator $detailViewGenerator
     * @param string $name
     */
    abstract public function buildDetailBlock($detailViewGenerator, $name);


}