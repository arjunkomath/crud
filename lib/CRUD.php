<?php

namespace CRUD;

class CRUD {

    public function read($table, $id = null) {
        $data = \ORM::for_table($table);
        if($id){
            $data = $data->where_id_is($id)->find_array();
            return $data[0];
        }
        return $data->find_array();
    }

    public function save($table, $params, $id=null) {
        $table_object = \ORM::for_table($table);
        if($id) {
            $table_row = $table_object->where_id_is($id)->find_one();
        } else {
            $table_row = $table_object->create();
        }
        foreach ($params as $key => $value) {
            $table_row->$key = $value;
        }
        $table_row->save();
        return $table_row->id();
    }

    public function find($table, $key, $value) {
        return \ORM::for_table($table)
            ->where($key, $value)
            ->find_array();
    }

    public function delete($table, $id) {
        return \ORM::for_table($table)->where_id_is($id)->find_one()->delete();
    }

}

?>
