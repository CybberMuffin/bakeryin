<?php
namespace application\libs;

use PDO;

class DBSQL
{
    private $connect;
    private $table;
    private $findQuery;
    private $getQuery;
    private $arrayExecute = array();
    private $where;
    private $delete;
    private $insert;
    private $update;
    private static $statConnect;


    function __construct($dbname, $table)
    {
        $this->table = $table;
        $this->connect = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');
    }

    function connect($dbname, $table)
    {
        $this->table = $table;
        $this->connect = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');
    }

    function statConnect($dbname, $table)
    {
        $this->table = $table;
        static::$statConnect = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');
    }

    function find($sql, $db)
    {
        $this->findQuery = $this->connect->prepare("SELECT * FROM $this->table WHERE $sql = :db LIMIT 1");
        $this->findQuery->bindParam("db", $db);
        $this->findQuery->execute();

        return $this->findQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    function exists($sql_var, $php_var)
    {
        $STH = $this->connect->prepare("SELECT $sql_var FROM $this->table WHERE $sql_var = ?");
        $STH->bindParam(1, $php_var);
        $STH->execute();

        if($STH->rowCount() > 0)
            return true;
        else
            return false;
    }

    function get()
    {
        $this->getQuery = $this->connect->prepare("SELECT * FROM $this->table $this->where");
        $this->getQuery->execute($this->arrayExecute);

        $this->where = '';
        $this->arrayExecute = array();

        return $this->getQuery->fetchAll();
    }

    function where($columnName, $columnValue)
    {
        if(!$this->where)
        {
            $this->where = "WHERE $columnName = ?";
            $this->arrayExecute[] = $columnValue;
        }
        else{
            $this->where .= " AND $columnName = ?";
            $this->arrayExecute[] = $columnValue;
        }

        return $this;
    }
////////////////////////////////////////////////////////////////////
/// Special cut
/// Can be deleted
///
///
    public function query($sql, $params = []) {
        $stmt = $this->connect->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }
    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
//////////////////////////////////////////////////////////////////////////
///
///
    function order_by($new_order = "id")
    {
        $this->order = " ORDER BY $new_order ASC";
        return $this;
    }

    function delete()
    {
        $this->delete = $this->connect->prepare("DELETE FROM $this->table $this->where");
        $this->where = '';
        $temp = $this->arrayExecute;
        $this->arrayExecute = array();

        return $this->delete->execute($temp);
    }

    function insert($field, $data)
    {
        $field_values = implode(', ', $field);
        $string = '?';
        for ($i = 1; $i < count($data); $i++)
            $string .= ", ?";

        $this->insert = $this->connect->prepare("INSERT INTO $this->table ($field_values) VALUES ($string)");
        return $this->insert->execute($data);
    }

    function update($field, $data)
    {
        /*$query = $field[0] . " = ?";
        for ($i = 1; $i < count($field); $i++)
            $query .= ", " . $field[$i] . " = ?";*/

        $query = $field[0] . " = '$data[0]'";
        for ($i = 1; $i < count($field); $i++)
            $query .= ", $field[$i] = '$data[$i]'";

        $this->update = $this->connect->prepare("UPDATE $this->table SET $query $this->where");

        $this->where = '';
        $temp = $this->arrayExecute;
        $this->arrayExecute = array();

        return $this->update->execute($temp);
    }

}
