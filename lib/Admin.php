<?php
namespace CRUD;

use CRUD\Views\Read;

class Admin {

    public function __construct($config = null) {    
    }

    public function read($table, $id = null) {
        $data['rows'] = \ORM::for_table($table)->find_array();
        $this->view = new Read('read', $data);
    }

    public function create($table) {
    }

    public function update($table) {
    }

    public function delete($table) {
    }

}
