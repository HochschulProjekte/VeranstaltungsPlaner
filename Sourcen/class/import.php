<?php

/**
 * Class Import
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class Import {

    protected $values;
    protected $file;

    /**
     * Import constructor.
     * @param null $file
     */
    function __construct($file = null) {
        if ($file != null) {
            $this->setFile($file);
            $this->readFile($file);
        }
    }

    /**
     * Datei lesen.
     * @param $file
     */
    public function readFile($file) {

        $values = [];
        $a = [];

        $values = file($file);

        foreach ($values as &$row)
            $row = str_getcsv($row, ';');

        array_walk($values, function (&$a) use ($values) {
            $a = array_combine($values[0], $a);
        });

        array_shift($values);

        $this->setValues($values);
    }

    /**
     * Liefert die aktuelle Datei.
     * @return mixed
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @param $file
     */
    public function setFile($file) {
        $this->file = $file;
    }

    /**
     * Liefert die Werte der importieren Datei.
     * @return array string
     */
    public function getValues() {
        return $this->values;
    }

    /**
     * Speichert die Werte der importierten Datei.
     * @param array string $values
     */
    public function setValues($values) {
        $this->values = $values;
    }

}

?>