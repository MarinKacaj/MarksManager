<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 10:20 PM
 */

namespace fti\adv_db\property;


use DOMElement;
use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;
use fti\adv_db\view\ListViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

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
     * @param string $name
     * @param string $colName
     * @param string $type
     * @param string $label
     */
    function __construct($name, $colName, $type, $label)
    {
        $this->name = $name;
        $this->colName = $colName;
        $this->type = $type;
        $this->label = $label;
    }


    /**
     * @return mixed
     */
    abstract public function getValue();

    /**
     * @param mixed $value
     * @return void
     */
    abstract public function setValue($value);

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
     * @param FormViewGenerator $formViewGenerator
     * @param string $name
     */
    abstract public function buildFormBlock($formViewGenerator, $name);

    /**
     * @param DetailViewGenerator $detailViewGenerator
     * @param string $name
     */
    abstract public function buildDetailBlock($detailViewGenerator, $name);

    /**
     * @param ListViewGenerator $listViewGenerator
     * @param string $name
     */
    abstract public function buildListBlock($listViewGenerator, $name);


}