<?php
namespace CRUD;

use CRUD\CRUD;
use CRUD\Views\Table;
use CRUD\Views\Read;
use CRUD\Views\Create;
use CRUD\Views\Update;

class Admin {

    public function __construct($config = null) {    
        $this->crud = new CRUD();
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
            if($ignore_keys) {
                foreach ($fields as $key => $field) {
                    if(in_array($field['Field'], $ignore_keys))
                        unset($fields[$key]);
                }
            }
            $data['fields'] = $fields;
            $this->view = new Create('create', $data);
        }
    }

    public function read($table, $id, $ignore_keys = null) {
        $row = $this->crud->read($table, $id);
        if($ignore_keys) {
            foreach ($row as $key => $value) {
                if(in_array($key, $ignore_keys))
                    unset($row[$key]);
            }
        }
        $data['row'] = $row;
        $this->view = new Read('read', $data);
    }

    public function update($table, $id, $ignore_keys = null) {
        if($_POST) {
            $params = $_POST;
            $this->crud->save($table, $params, $id);
            $this->view = new Create('done');
        } else {
            $fields = \ORM::for_table($table)->raw_query('DESCRIBE '.$table)->find_array();
            $row = $this->crud->read($table, $id);
            if($ignore_keys) {
                foreach ($row as $key => $value) {
                    if(in_array($key, $ignore_keys))
                        unset($row[$key]);
                }
                foreach ($fields as $key => $field) {
                    if(in_array($field['Field'], $ignore_keys))
                        unset($fields[$key]);
                }
            }
            $data['fields'] = $fields;
            $data['row'] = $row;
            $this->view = new Update('update', $data);
        }
    }

    public function delete($table, $id) {
    }

}
