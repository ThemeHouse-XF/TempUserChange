<?php

/**
 * Route prefix handler for temp user changes in the public system.
 */
class ThemeHouse_TempUserChange_Route_Prefix_TempUserChanges implements XenForo_Route_Interface
{

    /**
     * Match a specific route for an already matched prefix.
     *
     * @see XenForo_Route_Interface::match()
     */
    public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
    {
        $action = $router->resolveActionWithIntegerParam($routePath, $request, 'user_change_temp_id');
        return $router->getRouteMatch('ThemeHouse_TempUserChange_ControllerPublic_TempUserChange', $action, 'members');
    } /* END match */

    /**
     * Method to build a link to the specified page/action with the provided
     * data and params.
     *
     * @see XenForo_Route_BuilderInterface
     */
    public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
    {
        return XenForo_Link::buildBasicLinkWithIntegerParam($outputPrefix, $action, $extension, $data, 'user_change_temp_id');
    } /* END buildLink */
}