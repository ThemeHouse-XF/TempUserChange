<?php

class ThemeHouse_TempUserChange_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_TempUserChange' => array(
                'model' => array(
                    'XenForo_Model_User',
                    'XenForo_Model_UserChangeTemp'
                ), /* END 'model' */
                'controller' => array(
                    'XenForo_ControllerPublic_Member'
                ), /* END 'controller' */
            ), /* END 'ThemeHouse_TempUserChange' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_TempUserChange_Listener_LoadClass($class, $extend, 'model');
        $extend = $loadClassModel->run();
    } /* END loadClassModel */

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_TempUserChange_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    } /* END loadClassController */
}