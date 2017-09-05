<?php

    interface DatabaseHandler {

        function select($table, $where);
        function update($table, $column_items, $where);
        function delete($table, $where);
    }

?>