<?php

/**
 *
 * @see XenForo_ControllerPublic_Member
 */
class ThemeHouse_TempUserChange_Extend_XenForo_ControllerPublic_Member extends XFCP_ThemeHouse_TempUserChange_Extend_XenForo_ControllerPublic_Member
{

    /**
     *
     * @see XenForo_ControllerPublic_Member::actionMember()
     */
    public function actionMember()
    {
        $response = parent::actionMember();

        if ($response instanceof XenForo_ControllerResponse_View) {
            $userModel = $this->_getUserModel();

            $user = $response->params['user'];

            if ($userModel->canViewTempUserChanges()) {
                $canViewTempUserChanges = true;
                $tempUserChangeCount = $this->getModelFromCache('XenForo_Model_UserChangeTemp')->countTempUserChangesByUser($user['user_id']);
            } else {
                $canViewTempUserChanges = false;
                $tempUserChangeCount = 0;
            }

            $response->params['tempUserChangeCount'] = $tempUserChangeCount;
            $response->params['canViewTempUserChanges'] = $canViewTempUserChanges;
        }

        return $response;
    } /* END actionMember */

    public function actionTempUserChanges()
    {
        $userId = $this->_input->filterSingle('user_id', XenForo_Input::UINT);
        $user = $this->getHelper('UserProfile')->assertUserProfileValidAndViewable($userId);

        /* @var $userChangeTempModel XenForo_Model_UserChangeTemp */
        $userChangeTempModel = $this->getModelFromCache('XenForo_Model_UserChangeTemp');

        if (!$this->_getUserModel()->canViewTempUserChanges())
        {
            return $this->responseNoPermission();
        }

        $tempUserChanges = $userChangeTempModel->getTempUserChangesByUser($user['user_id']);
        if (!$tempUserChanges)
        {
            return $this->responseMessage(new XenForo_Phrase('th_this_member_has_no_temp_changes_tempuserchange'));
        }

        $tempUserChanges = $userChangeTempModel->prepareTempUserChanges($tempUserChanges);

        $viewParams = array(
            'user' => $user,
            'tempUserChanges' => $tempUserChanges
        );
        return $this->responseView('ThemeHouse_TempUserChange_ViewPublic_Member_TempUserChanges', 'th_member_temp_changes_tempuserchange', $viewParams);
    } /* END actionTempUserChanges */
}