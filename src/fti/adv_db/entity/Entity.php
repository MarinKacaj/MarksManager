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

    const UNSAVED_INSTANCE_ID = 0;
    const ALL_PROPERTIES = 1;
    const PROP_ID = 'id';
    const PROPERTY_PREFIX = 'PROP_';

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
    protected $tableName;
    /**
     * @var string
     */
    protected $label;


    /**
     * @return string
     */
    abstract public function getEntityName();

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
        if ($id >= self::UNSAVED_INSTANCE_ID) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @param string[] $params
     */
    protected function setIdFromParams($params)
    {
        if (isset($params[self::PROP_ID])) {
            $id = $params[self::PROP_ID];
            $this->setId($id);
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
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
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