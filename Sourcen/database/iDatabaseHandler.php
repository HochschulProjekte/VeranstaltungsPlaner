<?php

    interface DatabaseHandler {

        function select($table, $where, $orderby = NULL);
        function insert($table, $column_items);
        function update($table, $column_items, $where);
        function delete($table, $where);

        function count($table, $column, $where);
    }

?>