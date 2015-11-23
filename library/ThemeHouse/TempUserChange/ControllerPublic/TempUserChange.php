<?php

class ThemeHouse_TempUserChange_ControllerPublic_TempUserChange extends XenForo_ControllerPublic_Abstract
{

    public function actionIndex()
    {
        $userChangeTempId = $this->_input->filterSingle('user_change_temp_id', XenForo_Input::UINT);
        $change = $this->_getTempUserChangeOrError($userChangeTempId);

        if (!$this->_getUserModel()->canViewTempUserChanges()) {
            return $this->responseNoPermission();
        }

        $user = $this->_getUserModel()->getUserById($change['user_id']);
        if (!$user) {
            return $this->responseError(
                new XenForo_Phrase('th_user_who_received_this_temp_user_change_no_longer_exists_tempuserchange'));
        }

        $viewParams = array(
            'change' => $change,
            'user' => $user,
            'canEditTempUserChange' => $this->_getUserModel()->canEditTempUserChanges(),
            'redirect' => $this->getDynamicRedirect()
        );
        return $this->responseView('ThemeHouse_TempUserChange_ViewPublic_TempUserChange_Info',
            'th_temp_user_change_info_tempuserchange', $viewParams);
    } /* END actionIndex */

    public function actionExpire()
    {
        $userChangeTempId = $this->_input->filterSingle('user_change_temp_id', XenForo_Input::UINT);
        $change = $this->_getTempUserChangeOrError($userChangeTempId);

        if (!$this->_getUserModel()->canViewTempUserChanges() || !$this->_getUserModel()->canEditTempUserChanges()) {
            return $this->responseNoPermission();
        }

        if ($this->isConfirmedPost()) {
            $expire = $this->_input->filterSingle('expire', XenForo_Input::STRING);
            if ($expire == 'now') {
                $this->_getUserChangeTempModel()->expireTempUserChange($change);
            } elseif ($expire == 'future') {
                $expiryLength = $this->_input->filterSingle('expiry_length', XenForo_Input::UINT);
                $expiryUnit = $this->_input->filterSingle('expiry_unit', XenForo_Input::STRING);

                $expiryDate = strtotime("+$expiryLength $expiryUnit");
                $expiryDate = min(pow(2, 32) - 1, $expiryDate);
                if (!$expiryDate || $expiryDate < XenForo_Application::$time) {
                    $expiryDate = XenForo_Application::$time;
                }

                $this->_getUserChangeTempModel()->updateTempUserChangeExpiryDate($userChangeTempId, $expiryDate);
            } else {
                return $this->responseReroute(__CLASS__, 'index');
            }

            return $this->responseRedirect(XenForo_ControllerResponse_Redirect::SUCCESS, $this->getDynamicRedirect());
        } else {
            return $this->responseReroute(__CLASS__, 'index');
        }
    } /* END actionExpire */

    /**
     * Gets the specified temporary user change or throws an error.
     *
     * @param integer $id
     *
     * @return array
     */
    protected function _getTempUserChangeOrError($id)
    {
        return $this->_getUserChangeTempModel()->prepareTempUserChange(
            $this->getRecordOrError($id, $this->_getUserChangeTempModel(), 'getTempUserChangeById',
                'th_requested_temp_user_change_not_found_tempuserchange'));
    } /* END _getTempUserChangeOrError */

    /**
     *
     * @return XenForo_Model_UserChangeTemp
     */
    protected function _getUserChangeTempModel()
    {
        return $this->getModelFromCache('XenForo_Model_UserChangeTemp');
    } /* END _getUserChangeTempModel */

    /**
     *
     * @return XenForo_Model_User
     */
    protected function _getUserModel()
    {
        return $this->getModelFromCache('XenForo_Model_User');
    } /* END _getUserModel */
}