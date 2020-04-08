<?php

class User_model extends CI_Model {
  
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function get_users() {
    return $this->db->get('user');
  }

  public function login($where) {
    $query = $this->db->get_where('user', $where);
    if ($query) {
      return $query->row();
    }
    return false;
  }

  public function register($data) {
    return $this->db->insert('user', $data);
  }

  public function get_user_by_username($username) {
    return $this->db->get_where('user', $username);
  }

  public function get_user_by_id($id) {
    return $this->db->get_where('user', $id);
  }

}