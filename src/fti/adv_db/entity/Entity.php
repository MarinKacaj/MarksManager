<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 10:02 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\property\BasicProperty;
use InvalidArgumentException;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

abstract class Entity
{

    /**
     * @var int
     */
    const UNSAVED_INSTANCE_ID = 0;
    /**
     * @var int
     */
    const ALL_PROPERTIES = 1;

    /**
     * @var int
     */
    protected $id;
    /**
     * @var array
     */
    protected $properties;
    /**
     * @var string
     */
    protected $label;
    /**
     * @var string
     */
    protected $entityName;

    /**
     * @param int $id
     * @param string $label
     */
    function __construct($id, $label)
    {
        $this->setId($id);
        $this->properties = array();
        $this->entityName = get_class();

        $this->label = $label;
    }


    /**
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        if ($id >= 0) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return BasicProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param string $propertyName
     * @return BasicProperty
     */
    public function getProperty($propertyName)
    {
        return $this->properties[$propertyName];
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    abstract public function getDisplayName();

    /**
     * @return Entity[]
     */
    abstract public function getList();


}