<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Sql_model extends CI_Model 
{
    // Select table
    public function select_table($table, $where = null, $order_by = null, $order = 'asc', $limit = null)
    {
        if (isset($where)) {
            $this->db->where($where);
        }

        if (isset($limit)) {
            $this->db->limit($limit);
        }

		if (isset($order_by)) {
            $this->db->order_by($order_by, $order);
        }

        $query = $this->db->get($table);
        return $query;
    }

    // Manual Query
    public function manual_query($query)
    {
        return $this->db->query($query);
    }

    // Select with in condition
	public function select_table_in($table, $column, $in = [], $order_by = null, $order = 'asc')
	{
		$this->db->where_in($column, $in);

		if (isset($order_by)) {
            $this->db->order_by($order_by, $order);
        }

		$query = $this->db->get($table);
        return $query;
	}

    // Insert
    public function insert_table($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    // Update
    public function update_table($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        return true;
    }

    // Inner Join
    public function select_table_join($table, $column, $join_table, $join_on, $join, $where = array(1 => 1), $order_by = null, $order = 'asc')
    {
        if ($order_by != null) {
            $this->db->order_by($order_by, $order);
        }
        $this->db->select($column);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->join($join_table, $join_on, $join);
        return $this->db->get();
    }

    // Count table data
	public function count_table($table, $where = [])
	{
		if (isset($where)) {
            $this->db->where($where);
        }

		return $this->db->count_all_results($table);
	}

    // Delete
    public function delete_table($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return true;
    }          
                        
}


/* End of file Sql_model.php and path \application\models\Sql_model.php */
