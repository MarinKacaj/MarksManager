<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 7:10 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class User
 * @package fti\adv_db\entity
 */
abstract class UserEntity extends BasicEntity
{

    const PROP_EMAIL = 'email';
    const PROP_PASSWORD = 'password';

    /**
     * @param array $params
     */
    public function __construct($params)
    {
        $this->properties[self::PROP_EMAIL] = new StringProperty(self::PROP_EMAIL, 'Email', $params[self::PROP_EMAIL], true, true);
        $this->properties[self::PROP_PASSWORD] = new StringProperty(self::PROP_PASSWORD, 'Password', $params[self::PROP_PASSWORD], true, true);
    }


    /**
     * @param string $testedPassword
     * @return bool
     */
    public function isPasswordCorrect($testedPassword)
    {
        return strcmp($this->getProperty(self::PROP_PASSWORD)->getValue(), $testedPassword) === 0;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->getProperty(self::PROP_PASSWORD)->setValue($password);
    }
}