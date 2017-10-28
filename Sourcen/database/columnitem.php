<?php

    /**
     * Class ColumnItem
     * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
     */
    class ColumnItem {
        public $name;
        public $value;

        /**
         * ColumnItem constructor.
         * @param $name
         * @param $value
         */
        function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

    }
?>