<?php

/**
 * Class ArrayHelper
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class ArrayHelper {
    /**
     * Eintrag aus Array loeschen.
     * @param array $array
     * @param object $value
     * @param bool $strict
     * @return array
     */
    public static function unsetValue(array $array, $value, $strict = TRUE) {
        if (($key = array_search($value, $array, $strict)) !== FALSE) {
            unset($array[$key]);
        }

        $newArray = [];

        foreach ($array as $entry) {
            array_push($newArray, $entry);
        }

        return $newArray;
    }
}

?>