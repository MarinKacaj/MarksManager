<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/9/2015
 * Time: 8:56 PM
 */

namespace fti\adv_db\view;


use DOMElement;
use fti\adv_db\dom\Attribute;
use fti\adv_db\dom\Element;

require_once dirname(dirname(__FILE__)) . '/constants/gen_purpose.php';
require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class ListViewGenerator
 * @package fti\adv_db\view
 */
class ListViewGenerator extends ViewGenerator
{

    /**
     * @var DOMElement
     */
    private $listContainerEl;
    /**
     * @var string[]
     */
    private $colNames;
    /**
     * @var bool
     */
    private $tableHasActions;

    /**
     * @param string[] $colNames
     * @param bool $tableHasActions
     */
    function __construct($colNames, $tableHasActions)
    {
        parent::__construct();

        $this->colNames = $colNames;
        $this->tableHasActions = $tableHasActions;
        $this->listContainerEl = $this->domDocument->createElement(Element::TABLE_BODY);
    }


    /**
     * @return DOMElement
     */
    private function createTableHead()
    {
        $tableHeadEl = $this->domDocument->createElement(Element::TABLE_HEAD);

        if ($this->tableHasActions === true) {
            $tableHeadColEl = $this->domDocument->createElement(Element::TABLE_HEAD_COL);
            $tableHeadColTitle = $this->domDocument->createTextNode('Veprime');
            $tableHeadColEl->appendChild($tableHeadColTitle);
            $tableHeadEl->appendChild($tableHeadColEl);
        }

        foreach ($this->colNames as $colName) {
            $tableHeadColEl = $this->domDocument->createElement(Element::TABLE_HEAD_COL);
            $tableHeadColTitle = $this->domDocument->createTextNode($colName);
            $tableHeadColEl->appendChild($tableHeadColTitle);
            $tableHeadEl->appendChild($tableHeadColEl);
        }
        unset($colName);

        return $tableHeadEl;
    }

    /**
     * @return DOMElement
     */
    private function createTable()
    {
        $tableEl = $this->domDocument->createElement(Element::TABLE);
        $tableEl->setAttribute(Attribute::CLASS_NAME, 'table table-striped table-bordered table-hover');
        $tableEl->setAttribute(Attribute::ID, DATA_TABLE_ID);
        $tableHeadEl = $this->createTableHead($this->colNames);
        $tableEl->appendChild($tableHeadEl);

        return $tableEl;
    }

    /**
     * @return DOMElement
     */
    public function createTableContainer()
    {
        $tableContainerEl = $this->domDocument->createElement(Element::DIV);

        $tableContainerEl->setAttribute(Attribute::CLASS_NAME, 'table-responsive');
        $tableEl = $this->createTable($this->colNames);
        $tableEl->appendChild($this->listContainerEl);

        return $tableEl;
    }

    /**
     * @param string $url
     * @param bool $isDelete
     * @return DOMElement
     */
    private function createActionLink($url, $isDelete)
    {
        $linkEl = $this->domDocument->createElement(Element::LINK);
        $linkEl->setAttribute(Attribute::HREF, $url);

        $pullClassName = $isDelete ? 'pull-left' : 'pull-right';
        // $actionIconClassName = $isDelete ? 'fa-user-times' : 'fa-user';
        $actionIconClassName = $isDelete ? 'fa-times' : 'fa-user';
        $iconEl = $this->domDocument->createElement(Element::ICON);
        $iconEl->setAttribute(Attribute::CLASS_NAME, "fa $actionIconClassName fa-2x $pullClassName");
        $linkEl->appendChild($iconEl);

        return $linkEl;
    }

    /**
     * @param string[] $values
     * @param string $deleteURL [optional]
     * @param string $updateURL [optional]
     * @return DOMElement
     */
    public function createRow($values, $deleteURL = '', $updateURL = '')
    {
        $tableRowEl = $this->domDocument->createElement(Element::TABLE_ROW);

        if ($this->tableHasActions === true) {
            $cellEl = $this->domDocument->createElement(Element::TABLE_TD);
            $updateLinkEl = $this->createActionLink($updateURL, false);
            $cellEl->appendChild($updateLinkEl);
            $deleteLinkEl = $this->createActionLink($deleteURL, true);
            $cellEl->appendChild($deleteLinkEl);
            $tableRowEl->appendChild($cellEl);
        }

        foreach ($values as $value) {
            $cellEl = $this->domDocument->createElement(Element::TABLE_TD);
            $cellText = $this->domDocument->createTextNode($value);
            $cellEl->appendChild($cellText);
            $tableRowEl->appendChild($cellEl);
        }
        unset($value);

        return $tableRowEl;
    }

    /**
     * @param string[] $values
     * @param string $deleteURL [optional]
     * @param string $updateURL [optional]
     */
    public function appendRow($values, $deleteURL = '', $updateURL = '')
    {
        $tableRowEl = $this->createRow($values, $deleteURL, $updateURL);
        $this->listContainerEl->appendChild($tableRowEl);
    }

    /**
     * @return DOMElement
     */
    public function getListContainerEl()
    {
        return $this->listContainerEl;
    }

    /**
     * @return DOMElement
     */
    public function createCreateButton()
    {
        $linkEl = $this->domDocument->createElement(Element::LINK);
        $linkEl->setAttribute(Attribute::HREF, 'create.php');

        $createButtonEl = $this->domDocument->createElement(Element::BUTTON);
        $createButtonEl->setAttribute(Attribute::CLASS_NAME, 'btn btn-default');
        $buttonText = $this->domDocument->createTextNode('Shto');
        $createButtonEl->appendChild($buttonText);
        $linkEl->appendChild($createButtonEl);

        return $linkEl;
    }

    /**
     * @param bool $appendCreateButton [optional]
     * @return string
     */
    public function getBuiltHTML($appendCreateButton = true)
    {
        $tableContainerEl = $this->createTableContainer();
        $tableContainerEl->appendChild($this->listContainerEl);
        $this->domDocument->appendChild($tableContainerEl);
        if ($appendCreateButton) {
            $createButtonEl = $this->createCreateButton();
            $this->domDocument->appendChild($createButtonEl);
        }
        $rawHTML = $this->domDocument->saveHTML();
        $decodedHTML = html_entity_decode($rawHTML);
        return $decodedHTML;
    }


}