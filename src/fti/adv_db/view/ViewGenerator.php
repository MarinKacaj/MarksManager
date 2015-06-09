<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 8:45 PM
 */

namespace fti\adv_db\view;


use DOMDocument;

/**
 * Class ViewGenerator
 * @package fti\adv_db\view
 */
class ViewGenerator
{

    /**
     * @var DOMDocument
     */
    protected $domDocument;
    /**
     * @var int
     */
    protected $genericDomID;

    function __construct()
    {
        $this->domDocument = new DOMDocument('1.0', 'iso-8859-1');
        $this->genericDomID = 0;
    }

    /**
     * @return mixed
     */
    public function getDomDocument()
    {
        return $this->domDocument;
    }

    /**
     * @return int
     */
    protected function genUniqueID()
    {
        $this->genericDomID += 1;
        return $this->genericDomID;
    }


}