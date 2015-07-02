<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/21/2015
 * Time: 9:48 PM
 */

namespace fti\adv_db\nav;

use fti\adv_db\entity\BasicEntity;
use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Secretary;
use fti\adv_db\entity\Student;
use fti\adv_db\entity\UserEntity;
use fti\adv_db\exceptions\MySQLException;
use InvalidArgumentException;

require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/assets/includes/session.php';

require_once dirname(dirname(__FILE__)) . '/constants/gen_purpose.php';
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
     * @var string
     */
    private $assetsBaseURL;

    /**
     * @param BasicEntity $entityInstance
     */
    function __construct($entityInstance)
    {
        $this->entityInstance = $entityInstance;
        $this->assetsBaseURL = get_assets_base_url();
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
        $this->redirectToPath($this->assetsBaseURL . 'main.php');
    }

    private function redirectForError($page, $message)
    {
        $errorArgs = array(REPORT_CODE => $message);
        $errorURLParams = http_build_str($errorArgs);
        $this->redirectToPath($this->assetsBaseURL . "$page?$errorURLParams");
    }

    /**
     * @param int $message [optional]
     */
    public function redirectToLogInPage($message = REPORT_LOGIN_ERROR_INVALID_CREDENTIALS)
    {
        $this->redirectForError('auth/login.php', $message);
    }

    private function redirectToDefaultErrorPage()
    {
        $this->redirectToPath($this->assetsBaseURL . ERROR_DEFAULT_FILE_NAME);
    }

    /**
     * @param string $path
     * @param int $errorCode
     * @return string
     */
    private function buildErrorPath($path, $errorCode)
    {
        if ($errorCode !== ERROR_NONE) {
            $errorArgs = http_build_str(array(REPORT_CODE => $errorCode));
            $path .= '?' . $errorArgs;
        }
        return $path;
    }

    /**
     * @param int $errorCode [optional]
     */
    private function redirectToListPage($errorCode = ERROR_NONE)
    {
        $path = LIST_DEFAULT_FILE_NAME;
        $path = $this->buildErrorPath($path, $errorCode);
        $this->redirectToPath($path);
    }

    /**
     * @param int $errorCode [optional]
     */
    private function redirectToCreatePage($errorCode = ERROR_NONE)
    {
        $path = CREATE_DEFAULT_FILE_NAME;
        $path = $this->buildErrorPath($path, $errorCode);
        $this->redirectToPath($path);
    }

    /**
     * @param int $errorCode [optional]
     */
    private function redirectToEditPage($errorCode = ERROR_NONE)
    {
        $path = EDIT_DEFAULT_FILE_NAME;
        $path = $this->buildErrorPath($path, $errorCode);
        $this->redirectToPath($path);
    }

    public function saveAndRedirect()
    {
        try {
            $this->entityInstance->save();
            $this->redirectToListPage();
        } catch (InvalidArgumentException $e) {
            $this->redirectToCreatePage($e->getCode());
        } catch (MySQLException $e) {
            $this->redirectToCreatePage($e->getCode());
        }
    }

    public function updateAndRedirect()
    {
        try {
            $this->entityInstance->update();
            $this->redirectToListPage();
        } catch (InvalidArgumentException $e) {
            $this->redirectToEditPage($e->getCode());
        } catch (MySQLException $e) {
            $this->redirectToEditPage($e->getCode());
        }
    }

    public function deleteAndRedirect()
    {
        try {
            $this->entityInstance->delete();
            $this->redirectToListPage();
        } catch (InvalidArgumentException $e) {
            $this->redirectToEditPage($e->getCode());
        } catch (MySQLException $e) {
            $this->redirectToEditPage($e->getCode());
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

            switch ($actor) {

                case Student::TABLE_NAME:
                    $this->redirectToPath("{$this->assetsBaseURL}studentResults/list.php");
                    break;
                case Professor::TABLE_NAME:
                    $this->redirectToPath("{$this->assetsBaseURL}result/filter.php");
                    break;
                case Secretary::TABLE_NAME:
                    $this->redirectToPath("{$this->assetsBaseURL}university/list.php");
                    break;
            }
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