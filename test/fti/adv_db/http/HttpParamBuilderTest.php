<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 11:16 AM
 */

namespace fti\adv_db\http;


use fti\adv_db\entity\Entity;
use fti\adv_db\entity\University;
use PHPUnit_Framework_TestCase;

require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/vendor/phpunit.phar';
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/src/fti/adv_db/entity/Entity.php';
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/src/fti/adv_db/entity/University.php';
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/src/fti/adv_db/http/HttpEntityParamBuilder.php';

/**
 * Class HttpParamBuilderTest
 * @package fti\adv_db\http
 */
class HttpParamBuilderTest extends PHPUnit_Framework_TestCase
{

    private $paramBuilder;
    private $properties;
    private $idName;
    private $idVal;

    protected function setUp()
    {
        $this->properties = array(
            University::PROP_NAME => 'UPT',
            University::PROP_CITY => 'Tirana'
        );
        $_POST = $this->properties;
        $this->idName = Entity::PROP_ID;
        $this->idVal = 5;
        $this->paramBuilder = new HttpEntityParamBuilder(University::getEntityClassName());
    }

    public function testGetPropertiesMap()
    {
        $this->assertArrayHasKey(Entity::PROP_ID, $this->properties);
    }
}
