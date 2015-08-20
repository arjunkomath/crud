<?php

namespace CRUD;

class CRUD {

    /**
     * read
     *
     * Read the specified table and find the object with specified id 
     * 
     * @param mixed $table 
     * @param mixed $id 
     * @access public
     * @return array
     */
    public function read($table, $id = null) {
        $data = \ORM::for_table($table);
        if($id){
            $data = $data->where_id_is($id)->find_array();
            return $data[0];
        }
        return $data->find_array();
    }

    /**
     * save
     *
     * Save data to db and return the id of the newly created entry 
     * 
     * @param mixed $table 
     * @param mixed $params 
     * @param mixed $id 
     * @access public
     * @return var
     */
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

    /**
     * find
     *
     *Find a entry in the specified table where key = value
     * 
     * @param mixed $table 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return array 
     */
    public function find($table, $key, $value) {
        return \ORM::for_table($table)
            ->where($key, $value)
            ->find_array();
    }

    /**
     * delete
     *
     * Delete an entry from the table where primary key is the specified id 
     * 
     * @param mixed $table 
     * @param mixed $id 
     * @access public
     * @return bool
     */
    public function delete($table, $id) {
        return \ORM::for_table($table)->where_id_is($id)->find_one()->delete();
    }

}

?>
