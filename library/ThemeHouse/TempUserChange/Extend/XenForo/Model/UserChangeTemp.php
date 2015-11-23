<?php

/**
 *
 * @see XenForo_Model_UserChangeTemp
 */
class ThemeHouse_TempUserChange_Extend_XenForo_Model_UserChangeTemp extends XFCP_ThemeHouse_TempUserChange_Extend_XenForo_Model_UserChangeTemp
{

    /**
     *
     * @param integer $userId
     */
    public function getTempUserChangesByUser($userId)
    {
        return $this->fetchAllKeyed(
            '
			SELECT user_change_temp.*
			FROM xf_user_change_temp AS user_change_temp
			WHERE user_change_temp.user_id = ?
			ORDER BY user_change_temp.create_date DESC
		', 'user_change_temp_id', $userId);
    } /* END getTempUserChangesByUser */

    public function updateTempUserChangeExpiryDate($userChangeTempId, $expiryDate)
    {
        return $this->_getDb()->query("
			UPDATE xf_user_change_temp
            SET expiry_date = ?
			WHERE user_change_temp_id = ?
		", array($expiryDate, $userChangeTempId));
    } /* END updateTempUserChangeExpiryDate */

    /**
     *
     * @param integer $userId
     */
    public function countTempUserChangesByUser($userId)
    {
        return $this->_getDb()->fetchOne(
            '
			SELECT COUNT(*)
			FROM xf_user_change_temp AS user_change_temp
			WHERE user_change_temp.user_id = ?
		', $userId);
    } /* END countTempUserChangesByUser */

    public function prepareTempUserChange(array $tempUserChange)
    {
        switch ($tempUserChange['action_type'])
        {
        	case 'groups':
        	    $tempUserChange['field'] = 'secondary_group_ids';
        	    break;

        	case 'field':
        	    $tempUserChange['field'] = $tempUserChange['action_modifier'];
        	    break;
        }

        $tempUserChange = $this->_getHelper()->prepareField($tempUserChange);

        switch ($tempUserChange['action_type'])
        {
        	case 'groups':
        	    $tempUserChange['name'] = new XenForo_Phrase('th_add_to_user_groups_tempuserchange');
        	    $tempUserChange['old_value'] = new XenForo_Phrase('n_a');
        	    break;

        	case 'field':

        	    break;
        }

        return $tempUserChange;
    } /* END prepareTempUserChange */

    public function prepareTempUserChanges(array $tempUserChanges)
    {
        foreach ($tempUserChanges as &$tempUserChange) {
            $tempUserChange = $this->prepareTempUserChange($tempUserChange);
        }

        return $tempUserChanges;
    } /* END prepareTempUserChanges */

    protected $_helperObject = null;

    /**
     * @return XenForo_Helper_UserChangeLog
     */
    protected function _getHelper()
    {
        if ($this->_helperObject === null)
        {
            $class = XenForo_Application::resolveDynamicClass('XenForo_Helper_UserChangeLog');
            $this->_helperObject = new $class();
        }

        return $this->_helperObject;
    } /* END _getHelper */
}