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
     * @return mixed
     */
    public function getValues() {
        return $this->values;
    }

    /**
     * @param $values
     */
    public function setValues($values) {
        $this->values = $values;
    }

}

?>