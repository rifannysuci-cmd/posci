<?php

class Auth extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_model');
  }

  public function index() {
    if ($this->session->userdata('user_data')) {
      redirect('myigniter');
    } else {
      $this->form_validation->set_rules('username', 'username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

      if ($this->form_validation->run() == false) {
        $this->load->view('auth/login');
      } else {
        $username = $this->input->post('username');
        $userpass = $this->input->post('password');

        $data = array(
          'username' => $username
        );
        $check_username = $this->user_model->get_user_by_username($data);
        if ($check_username->num_rows() == 1) {
          $hash = $check_username->row('password');
          if (password_verify($userpass, $hash)) {
            $result = $check_username->row();
            $userdata = array(
              'id' => $result->id,
              'username' => $result->username,
              'nama' => $result->nama,
            );
            $this->session->set_userdata('user_data', $userdata);
            redirect('myigniter');
          } else {
            $this->session->set_flashdata("wrong", "Wrong password, please try again.");
            $this->load->view('auth/login');
          }
        } else {
          $this->session->set_flashdata("not_exist", "Account is not existed.");
          $this->load->view('auth/login');
        }
      }
    }
  }

  public function register() {
    if ($this->session->userdata('user_data')) {
      redirect('myigniter');
    } else {

      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('nama', 'Nama', 'required');
  
      $username = $this->db->escape_str($this->input->post('username'));
      $where = array(
        'username' => $username,
      );
  
      $check_username = $this->user_model->get_user_by_username($where)->num_rows();
      if ($check_username > 0) {
        $this->form_validation->set_rules('username', 'Username', 'Username_check', array(
          'username_check' => 'This username already registed!'
        ));
      }
  
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|matches[password]');
      $this->form_validation->set_rules('confirm_password', 'Repeat Password', 'required|min_length[8]|matches[password]');
  
  
      if ($this->form_validation->run() == false) {
        $this->load->view('auth/register');
      } else {
        $data = array(
          'username' => $this->input->post('username'),
          'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
          'nama' => $this->input->post('nama'),
        );
  
        $result = $this->user_model->register($data);
  
        if ($result > 0) {
          $this->session->set_flashdata("success", "Your account has been registered. You can login now");
          $this->load->view('auth/register');
        }
      }
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect('auth');
  }

}