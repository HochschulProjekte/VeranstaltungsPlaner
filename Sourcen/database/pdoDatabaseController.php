<?php

include_once __DIR__ . '/../database/IDatabaseController.php';
include_once __DIR__ . '/../database/columnItem.php';

/**
 * Class PDOHandler
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class PDODatabaseController implements IDatabaseController {

    private $pdo;

    /**
     * PDOHandler constructor.
     */
    function __construct() {
        include __DIR__ . '/../database/credentials.php';
        $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db, $user, $pass);
    }

    /**
     * PDO select.
     * @param $table
     * @param $where
     * @param null $orderBy
     * @return array
     */
    function select($table, $where, $orderBy = NULL) {
        $sql_string = 'SELECT * FROM `' . $table . '`';

        if ($where != null) {
            $sql_string .= ' WHERE ' . $where;
        }

        if ($orderBy != null) {
            $sql_string .= ' ORDER BY ' . $orderBy;
        }

        $sql_string .= ';';

        $response = array();

        foreach ($this->pdo->query($sql_string) as $row) {
            array_push($response, $row);
        }

        return $response;
    }

    /**
     * PDO insert.
     * @param $table
     * @param $column_items
     * @return bool
     */
    function insert($table, $column_items) {
        $sql_string = 'INSERT INTO ' . $table . ' (';
        $value_string = '';

        foreach ($column_items as $index => $column_item) {

            if ($index != 0) {
                $sql_string = $sql_string . ', ';
                $value_string = $value_string . ', ';
            }

            $sql_string .= '`' . $column_item->name . '`';
            $value_string .= '"' . $column_item->value . '"';
        }

        $sql_string .= ') VALUES (' . $value_string . ');';

        $affected = $this->pdo->exec($sql_string);

        if ($affected == false) {
            return false;
        }

        if ($affected > 0) {
            return true;
        }

        return false;
    }

    /**
     * PDO update.
     * @param $table
     * @param $column_items
     * @param $where
     * @return bool
     */
    function update($table, $column_items, $where) {
        $sql_string = 'UPDATE ' . $table . ' SET';

        foreach ($column_items as $index => $column_item) {

            if ($index != 0) {
                $sql_string .= ',';
            }

            $sql_string .= ' ' . $column_item->name . ' = "' . $column_item->value . '"';
        }

        $sql_string .= ' WHERE ' . $where . ';';

        $affected = $this->pdo->exec($sql_string);

        if ($affected == false) {
            return false;
        }

        if ($affected > 0) {
            return true;
        }

        return false;
    }

    /**
     * PDO delete.
     * @param $table
     * @param $where
     * @return bool
     */
    function delete($table, $where) {
        $sql_string = 'DELETE FROM ' . $table . ' WHERE ' . $where . ';';

        $affected = $this->pdo->exec($sql_string);

        if ($affected == false) {
            return false;
        }

        if ($affected > 0) {
            return true;
        }

        return false;
    }

    /**
     * PDO count.
     * @param $table
     * @param $column
     * @param $where
     * @return mixed
     */
    function count($table, $column, $where) {
        $sql_string = 'SELECT COUNT(' . $column . ') as count FROM ' . $table;

        if ($where != null) {
            $sql_string .= ' WHERE ' . $where . ';';
        } else {
            $sql_string .= ';';
        }

        $response = array();

        foreach ($this->pdo->query($sql_string) as $row) {
            array_push($response, $row);
        }

        return $response[0]['count'];
    }

    /**
     * PDO query.
     * @param $query
     * @return array
     */
    function query($query) {
        $response = [];

        foreach ($this->pdo->query($query) as $row) {
            array_push($response, $row);
        }

        return $response;
    }
}

?>