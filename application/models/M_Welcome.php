<?php

class M_Welcome extends CI_Model
{
    public function getAllData($table, $where, $order)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($where, $order);
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataById($table, $column, $where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($column, $where);
        $query = $this->db->get();
        return $query->result();
    }
    public function delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
