<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/21/2015
 * Time: 9:48 PM
 */

namespace fti\adv_db\nav;

use fti\adv_db\entity\BasicEntity;
use fti\adv_db\entity\UserEntity;
use fti\adv_db\exceptions\MySQLException;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/assets/includes/session.php';

require_once dirname(dirname(__FILE__)) . '/constants/labels.php';
require_once dirname(dirname(__FILE__)) . '/constants/auth.php';

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';
require_once dirname(dirname(__FILE__)) . '/functions/http_utils.php';

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
        die();
    }

    public function redirectToMainPage()
    {
        $assetsBaseURL = get_assets_base_url();
        $this->redirectToPath($assetsBaseURL . 'main.php');
    }

    private function redirectForError($page, $message)
    {
        $errorArgs = array(REPORT_CODE => $message);
        $errorURLParams = http_build_str($errorArgs);
        $baseURL = get_assets_base_url();
        $this->redirectToPath($baseURL . "$page?$errorURLParams");
    }

    /**
     * @param int $message [optional]
     */
    public function redirectToLogInPage($message = REPORT_LOGIN_ERROR_INVALID_CREDENTIALS)
    {
        $this->redirectForError('auth/login.php', $message);
    }

    private function redirectToEditPage()
    {
        $updatePath = HttpEntityParamBuilder::buildArgumentsRelativePath(
            EDIT_DEFAULT_FILE_NAME,
            $this->entityInstance->getIdentifier()
        );
        $this->redirectToPath($updatePath);
    }

    private function redirectToDefaultErrorPage()
    {
        $this->redirectToPath(ERROR_DEFAULT_FILE_NAME);
    }

    public function saveAndRedirect()
    {
        try {
            $this->entityInstance->save();
            $this->redirectToEditPage();
        } catch (MySQLException $e) {
            $this->redirectToDefaultErrorPage();
        }
    }

    public function updateAndRedirect()
    {
        try {
            $this->entityInstance->update();
            $this->redirectToEditPage();
        } catch (MySQLException $e) {
            $this->redirectToDefaultErrorPage();
        }
    }

    public function deleteAndRedirect()
    {
        try {
            $this->entityInstance->delete();
            $this->redirectToPath(LIST_DEFAULT_FILE_NAME);
        } catch (MySQLException $e) {
            $this->redirectToDefaultErrorPage();
        }
    }

    /**
     * @param string $actor
     * @param int $error [optional]
     */
    public function logInAndRedirect($actor, $error = REPORT_LOGIN_ERROR_INVALID_CREDENTIALS)
    {
        if ($this->entityInstance) {
            $_SESSION[LOGGED_IN_USER_ID] = $this->entityInstance->getProperty(UserEntity::PROP_ID)->getValue();
            $_SESSION[LOGGED_IN_USER_ROLE] = $actor;
            $this->redirectToMainPage();
        } else {
            $this->redirectToLogInPage($error);
        }
    }

    public function logOutAndRedirect()
    {
        session_unset();
        session_destroy();
        $this->redirectToLogInPage(REPORT_LOGGED_OUT);
    }

    /**
     * @param bool $isCorrect
     */
    public function changePasswordAndRedirect($isCorrect)
    {
        $changePasswordFilePath = 'personal/' . CHANGE_PASSWORD_FILE;
        if (!$isCorrect) {
            $this->redirectForError($changePasswordFilePath, REPORT_PASSWORD_MISMATCH);
        }
        try {
            $this->entityInstance->update();
            $this->redirectToPath(CHANGE_PASSWORD_FILE);
        } catch (MySQLException $e) {
            $this->redirectForError($changePasswordFilePath, REPORT_PASSWORD_MISMATCH);
        }
    }

}