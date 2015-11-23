<?php

/**
 *
 * @see XenForo_Model_User
 */
class ThemeHouse_TempUserChange_Extend_XenForo_Model_User extends XFCP_ThemeHouse_TempUserChange_Extend_XenForo_Model_User
{

    /**
     * Determines if a user can view the temporary user changes
     *
     * @param string $errorPhraseKey
     * @param array|null $viewingUser
     *
     * @return boolean
     */
    public function canViewTempUserChanges(&$errorPhraseKey = '', array $viewingUser = null)
    {
        $this->standardizeViewingUserReference($viewingUser);

        if (!$viewingUser['user_id'] ||
             !XenForo_Permission::hasPermission($viewingUser['permissions'], 'general', 'viewTempUserChange')) {
            return false;
        }

        return true;
    } /* END canViewTempUserChanges */

    /**
     * Determines if a user can edit the temporary user changes
     *
     * @param string $errorPhraseKey
     * @param array|null $viewingUser
     *
     * @return boolean
     */
    public function canEditTempUserChanges(&$errorPhraseKey = '', array $viewingUser = null)
    {
        $this->standardizeViewingUserReference($viewingUser);

        if (!$viewingUser['user_id'] ||
             !XenForo_Permission::hasPermission($viewingUser['permissions'], 'general', 'editTempUserChange')) {
            return false;
        }

        return true;
    } /* END canEditTempUserChanges */
}