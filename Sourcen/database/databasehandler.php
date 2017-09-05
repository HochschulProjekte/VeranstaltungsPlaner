<?php

    include './i_databasehandler.php';
    include './columnitem.php';

    class PDOHandler implements DatabaseHandler {

        private $pdo;

        function __construct() {
            include './credentials.php';
            $this->pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
        }

        function select($table, $where) {
            $sql = 'SELECT * FROM '.$table;

            if($where != null) {
                $sql = $sql.' WHERE '.$where.';';
            } else {
                $sql = $sql.';';
            }

            $response = array();

            foreach($this->pdo->query($sql) as $row) {
                array_push($response, $row);
            }

            return $response;
        }

        function update($table, $column_items, $where) {
            $sql = 'UPDATE '.$table;

            foreach($column_items as $index => $column_item) {

                if($index != 0) {
                    $sql.=',';
                }

                $sql.= ' '.$column_item->name.' = "'.$column_item->value.'"';
            }
            
            $sql.= ' WHERE '.$where.';';

            return $this->pdo->exec($sql);
        }

        function delete($table, $where) {
            
        }
    }

?>