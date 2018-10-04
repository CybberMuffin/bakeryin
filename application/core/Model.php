<?php
namespace application\core;

use application\libs\DBSQL;

class Model   //ORM
{
    protected $table = null;
    protected $idField = 'id';
    protected $isAutoinc = true;
    private $isNew = true;
    protected $builder;
    private $attributes = [];

    public function __construct($attr = [],$isNew = true)
    {
        $this->setTable();
        $this->builder = new DBSQL('login_registr_db', $this->table);
        //$this->builder->connect('login_registr_db', $this->table);
        $this->isNew = $isNew;
        $this->attributes = $attr;
    }

    public function __get($name)
    {
        if (!empty($this->attributes)) {
            return array_key_exists($name, $this->attributes) ? $this->attributes[$name] : null;
        }
        else {
            return null;
        }
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __call($name, $arguments)
    {
        $res = call_user_func_array(array($this->builder, $name), $arguments);
        if($res instanceof DBSQL)
        {
            return $this;
        }
        if (is_array($res)) {
            $res_arr = [];
            foreach ($res as $key => $value) {
                array_push($res_arr, new static($value));
            }
            return $res_arr;
        }
        return false;
    }

    public static function __callStatic($name, $arguments)
    {
        $Model = new static();
        call_user_func_array(array($Model, $name), $arguments);
    }

    private function setTable()
    {
        if($this->table == null)
        {
            $this->table = strtolower(substr(get_class($this), 18))."s";
        }
    }

    public function get()
    {
        $res = $this->builder->get();
        $models = [];
        foreach ($res as $rec)
            array_push($models, new static($rec));

        return $models;
    }

    public function find($sql, $db) //finds one note by differ. fields
    {
        $result = $this->builder->find($sql, $db);
        $this->attributes = $result[0];
        $this->isNew = false;
    }

    function exists($sql_var, $php_var) // gives the answer on quest. whether this note exists or not
    {
        return $this->builder->exists($sql_var, $php_var);
    }

    public function note($field, $data) // writes new note
    {
        for ($i = 0; $i < sizeof($field); $i++)
            $this->attributes[$field[$i]] = $data[$i];
    }

    public function save() //saves the changes
    {
        $field = [];
        $data = [];
        foreach ($this->attributes as $key => $value)
        {
            array_push($field, $key);
            array_push($data, $value);
        }

        if($this->isNew) {
            $this->builder->insert($field, $data);
        } else {
            $this->builder
                ->where($this->idField, $this->attributes[$this->idField])
                ->update($field, $data);
        }
    }

    public function delete()
    {
        if(!$this->isNew) {
            $this->builder
                ->where($this->idField, $this->attributes[$this->idField])
                ->delete();
        }
    }

    public function setIsNew(bool $isNew): void
    {
        $this->isNew = $isNew;
    }

}