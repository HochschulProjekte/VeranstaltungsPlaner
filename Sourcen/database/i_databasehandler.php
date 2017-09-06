<?php

    interface DatabaseHandler {

        function select($table, $where);
        function insert($table, $column_items);
        function update($table, $column_items, $where);
        function delete($table, $where);
    }

?>