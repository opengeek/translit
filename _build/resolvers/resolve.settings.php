<?php
/**
 * Resolve the settings to setup the installed transliteration class
 *
 * @package translit
 * @subpackage _build
 */
$success = false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $translitClassPath = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_translit_class_path'));
        if (!$translitClassPath) {
            $translitClassPath = $transport->xpdo->newObject('modSystemSetting');
            $translitClassPath->fromArray(array(
                'key' => 'friendly_alias_translit_class_path',
                'namespace' => 'core',
                'xtype' => 'textfield',
                'value' => '',
                'area' => 'furls',
            ), '', true);
        }
        if ($translitClassPath) {
            $translitClassPath->set('value', '{core_path}components/translit/model/');
            $success = $translitClassPath->save();
        }
        $translitClass = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_translit_class'));
        if (!$translitClass) {
            $translitClass = $transport->xpdo->newObject('modSystemSetting');
            $translitClass->fromArray(array(
                'key' => 'friendly_alias_translit_class',
                'namespace' => 'core',
                'xtype' => 'textfield',
                'value' => '',
                'area' => 'furls',
            ), '', true);
        }
        if ($translitClass) {
            $translitClass->set('value', 'modx.translit.modTransliterate');
            $success = $translitClass->save();
        }
        break;
    case xPDOTransport::ACTION_UNINSTALL:
        $translitClassPath = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_translit_class_path'));
        if ($translitClassPath) {
            $translitClassPath->set('value', '{core_path}components/');
            $success = $translitClassPath->save();
        }
        $translitClass = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_translit_class'));
        if ($translitClass) {
            $translitClass->set('value', 'translit.modTransliterate');
            $success = $translitClass->save();
        }
        break;
}

return $success;