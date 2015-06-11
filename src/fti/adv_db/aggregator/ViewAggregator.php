<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 6/11/2015
 * Time: 3:08 PM
 */

namespace fti\adv_db\aggregator;


use fti\adv_db\entity\Entity;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class ViewAggregator
 * @package fti\adv_db\aggregator
 */
class ViewAggregator {

    /**
     * @var Entity
     */
    protected $entityInstance;

    /**
     * @param Entity $entityInstance
     */
    public function __construct($entityInstance)
    {
        $this->entityInstance = $entityInstance;
    }


}