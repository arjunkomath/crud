<?php
namespace CRUD;

use CRUD\Views\Read;

class Admin {

    public function __construct($config = null) {    
    }

    public function table($table, $ignore_keys = null) {
        $data['table'] = $table;
        $data['rows'] = \ORM::for_table($table)->find_array();
        if($ignore_keys)
            $data['filter'] = $ignore_keys;
        $this->view = new Table('table', $data);
    }

    public function create($table, $ignore_keys = null) {
        echo $table;
        $fields = \ORM::for_table($table)->raw_query('DESCRIBE '.$table)->find_array();
        foreach ($fields as $key => $field) {
            if(in_array($field['Field'], $ignore_keys))
                unset($fields[$key]);
        }
        $data['fields'] = $fields;
        $this->view = new Create('create', $data);
    }

    public function read($table, $id) {
    }

    public function update($table, $id) {
    }

    public function delete($table, $id) {
    }

}
