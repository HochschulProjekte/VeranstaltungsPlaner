<?php

class Import {

    protected $values;
    protected $file;

    function __construct($file = null) {
        if ($file != null) {
            $this->setFile($file);
            $this->readFile($file);
        }
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function setValues($values) {
        $this->values = $values;
    }

    public function getFile() {
        return $this->file;
    }

    public function getValues() {
        return $this->values;
    }

    public function readFile($file) {

        $values = [];
        $a = [];

        $values = file($file);
        
        foreach($values as &$row) $row = str_getcsv($row, ';');
        
        array_walk($values, function(&$a) use ($values) {
            $a = array_combine($values[0], $a);
        });

        array_shift($values);
        
        $this->setValues($values);
    }

}

?>