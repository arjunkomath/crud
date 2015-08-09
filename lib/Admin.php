<?php
namespace CRUD;

use CRUD\Views\Table;
use CRUD\Views\Read;
use CRUD\Views\Create;

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
        if($_POST) {
            $params = $_POST;
            $insert = \ORM::for_table($table)->create();
            \ORM::get_db()->beginTransaction();
            try {
                foreach ($params as $key => $value) {
                    $insert->$key = $value;
                }
                $insert->save();
                \ORM::get_db()->commit();
            } catch (Exception $e) {
                \ORM::get_db()->rollBack();
                throw $e;
            }
            $this->view = new Create('done');
        } else {
            $fields = \ORM::for_table($table)->raw_query('DESCRIBE '.$table)->find_array();
            foreach ($fields as $key => $field) {
                if(in_array($field['Field'], $ignore_keys))
                    unset($fields[$key]);
            }
            $data['fields'] = $fields;
            $this->view = new Create('create', $data);
        }
    }

    public function read($table, $id) {
    }

    public function update($table, $id) {
    }

    public function delete($table, $id) {
    }

}
