<?php
    class ColumnItem {
        public $name;
        public $value;

        function __construct() {
            $this->name = '';
            $this->value = '';
        }

        function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

    }
?>