<?php

class Import {

    private $fields = [];
    private $values = [];

    private $file;

    function __construct($file = null) {
        if ($file != null) {
            $this->setFile($file);
            $this->readFile($file);
        }
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function setFields($fields) {
        $this->fields = $fields;
    }

    public function addValues($values) {
        array_push($this->values, $values);
    }

    public function getFile() {
        return $this->file;
    }

    public function getFields() {
        return $this->fields;
    }

    public function getValues() {
        return $this->values();
    }

    function readFile($file) {
        $handle = fopen('filename', 'r');
        $values = [];
        $fields = [];
        $valuesByField = array();

        if ($handle) {

            while (($line = fgets($handle)) !== false) {

                if ($first === true) {
                    $first = false;
                    $this->setFields(explode(';', $line));
                } else {
                    $fields = $this->getFields();
                    $values = explode(';', $line);
                    for ($i = 0; $i < count($fields); $i++) {
                        $valuesByField[$fields[$i]] = $values[$i]; 
                    }
                    $this->addValues($valuesByField);
                }

            }

            fclose($handle);
        }
    }

}

?>