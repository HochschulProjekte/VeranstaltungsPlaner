<?php

/**
 * Class PositionMapping
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class PositionMapping {

    const positions = [
        'Montag 08:00',
        'Montag 12:00',
        'Dienstag 08:00',
        'Dienstag 12:00',
        'Mittwoch 08:00',
        'Mittwoch 12:00',
        'Donnerstag 08:00',
        'Donnerstag 12:00',
        'Freitag 08:00',
        'Freitag 12:00'
    ];

    const until = [
        'Montag 12:00',
        'Montag 16:00',
        'Dienstag 12:00',
        'Dienstag 16:00',
        'Mittwoch 12:00',
        'Mittwoch 16:00',
        'Donnerstag 12:00',
        'Donnerstag 16:00',
        'Freitag 12:00',
        'Freitag 16:00'
    ];

    /**
     * Liefert einen String fuer eine Position bspw. Position 4 => Dienstag 12:00
     * @param int $position
     * @return string
     */
    public static function map($position) {
        return self::positions[$position - 1];
    }

    /**
     * Liefert einen String fuer eine Position mit Laenge bspw. Position 4  Laenge 2 => Mittwoch 12:00
     * @param int $position
     * @param int $length
     * @return string
     */
    public static function mapUntil($position, $length) {

        $untilPos = $position + $length - 1;
        return self::until[$untilPos - 1];
    }
}

?>