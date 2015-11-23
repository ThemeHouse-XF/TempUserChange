<?php

class ThemeHouse_TempUserChange_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/TempUserChange/ControllerPublic/TempUserChange.php' => '23e5e4819dc920e386f1f3051b19c220',
                'library/ThemeHouse/TempUserChange/Extend/XenForo/ControllerPublic/Member.php' => 'e0ca1a03c5d1a053f28776bf5219350e',
                'library/ThemeHouse/TempUserChange/Extend/XenForo/Model/User.php' => '0ebcb525a9e543ebaa5b3e25c02b57de',
                'library/ThemeHouse/TempUserChange/Extend/XenForo/Model/UserChangeTemp.php' => '5db7be2e01e396c8a4bdbb05e9b295be',
                'library/ThemeHouse/TempUserChange/Install/Controller.php' => 'a93a34b2c1162bf0d431723a8460d917',
                'library/ThemeHouse/TempUserChange/Listener/LoadClass.php' => '947d78291c00be806a959279b617c228',
                'library/ThemeHouse/TempUserChange/Route/Prefix/TempUserChanges.php' => '60860f973502027395c8b7e423507343',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
            ));
    }
}