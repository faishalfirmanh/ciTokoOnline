<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Model {


   public function __construct()
    {
        parent::__construct();
    }

      public function loginPros($user,$pass)
      {
        $this->db->where('username', $user);
        $this->db->where('password', $pass);
        return $this->db->get('employee')->row();
      }

}
