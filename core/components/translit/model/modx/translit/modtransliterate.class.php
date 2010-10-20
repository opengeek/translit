<?php
/*
 * translit
 *
 * Copyright 2010 by MODx, LLC
 *
 * translit is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * translit is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * translit; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 */

/**
 * A transliteration service implementation class for MODx Revolution.
 *
 * @package modx
 * @subpackage translit
 */
class modTransliterate {

    /**
     * A reference to the modX instance communicating with this service instance.
     * @var modX
     */
    public $modx = null;
    /**
     * A collection of options.
     * @var array
     */
    public $options = array();

    /**
     * Constructs a new instance of the modTransliterate class.
     *
     * Use modX::getService() to get an instance of the translit service; do not manually construct this class.
     *
     * @param modX &$modx A reference to a modX instance.
     * @param array $options An array of options for configuring the modTransliterate instance.
     */
    public function __construct(modX &$modx, array $options = array()) {
        $this->modx = & $modx;
        $this->options = $options;
    }

    /**
     * Translate a string using a named transliteration table.
     *
     * @param string $string The string to transliterate.
     * @param string $table A named transliteration table to use.
     * @return string The translated string.
     */
    public function translate($string, $table) {
        $ret = $string;
        $filePath = dirname(__FILE__) . '/tables/' . $table . '.php';
        if (is_file($filePath)) {
            $table = include $filePath;
            if (is_array($table) && !empty($table)) {
                $ret = strtr($string, $table);
            }
        }
        return $ret;
    }
}