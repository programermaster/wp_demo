<?php
/**
 * ContentRotator
 *
 * Helper functions that assist the ContentRotatorWidget class
 */
class ContentRotator {
    /**
     * parse
     *
     * A simple parsing function for basic templating.
     *
     * @param $tpl
    string
    A formatting string containing
    [+placeholders+]
     * @param $hash
    array
    An associative array containing keys
    and values e.g. array('key' => 'value');
     * @return
    string
    Placeholders corresponding to the keys
    of the hash will be replaced with the values the resulting string
    will be returned.
     */
    static function parse($tpl, $hash) {
        foreach ($hash as $key => $value) {
            $tpl = str_replace('[+'.$key.'+]', $value, $tpl);
        }
        return $tpl;
    }
}