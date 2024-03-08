<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function get_user() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->db->from('tbl_authenticate')->where('auth_username', $username);
        $query = $this->db->get();
        $user = $query->row();

        if (!empty($user)) {
            if (verifyHashedPassword($password, $user->auth_pass) && strcmp($user->auth_username, $username) == 0) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public function change_password($aid, $apass) {
        $data = [
            'auth_pass' => $apass,
        ];
        $this->db->where('auth_id', $aid);

        if ($this->db->update('tbl_authenticate', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
