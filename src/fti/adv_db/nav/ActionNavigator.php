<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/21/2015
 * Time: 9:48 PM
 */

namespace fti\adv_db\nav;

use fti\adv_db\entity\BasicEntity;
use fti\adv_db\exceptions\MySQLException;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';
require_once dirname(dirname(__FILE__)) . '/constants/labels.php';

spl_autoload_register('class_auto_loader');

/**
 * Class ActionNavigator
 * @package fti\adv_db\nav
 */
class ActionNavigator
{

    /**
     * @var BasicEntity
     */
    private $entityInstance;

    /**
     * @param BasicEntity $entityInstance
     */
    function __construct($entityInstance)
    {
        $this->entityInstance = $entityInstance;
    }


    /**
     * @param string $path
     */
    private function redirectToPath($path)
    {
        header("Location: $path");
    }

    private function redirectToEditPage()
    {
        $updatePath = HttpEntityParamBuilder::buildArgumentsRelativePath(
            EDIT_DEFAULT_FILE_NAME,
            $this->entityInstance->getIdentifier()
        );
        $this->redirectToPath($updatePath);
    }

    private function redirectToErrorPage()
    {
        $this->redirectToPath(ERROR_DEFAULT_FILE_NAME);
    }

    public function saveAndRedirect()
    {
        try {
            $this->entityInstance->save();
            $this->redirectToEditPage();
        } catch (MySQLException $e) {
            $this->redirectToErrorPage();
        }
    }

    public function updateAndRedirect()
    {
        try {
            $this->entityInstance->update();
            $this->redirectToEditPage();
        } catch (MySQLException $e) {
            $this->redirectToErrorPage();
        }
    }

    public function deleteAndRedirect()
    {
        try {
            $this->entityInstance->delete();
            $this->redirectToPath(LIST_DEFAULT_FILE_NAME);
        } catch (MySQLException $e) {
            $this->redirectToErrorPage();
        }
    }

}