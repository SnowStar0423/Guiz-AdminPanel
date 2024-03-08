<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends CI_Controller {

    /**  This is default constructor of the class */
    public function __construct() {
        parent::__construct();
        $this->load->helper('password_helper');
        $this->load->library('session');

        $this->result['full_logo'] = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
        $this->result['half_logo'] = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
        $this->result['app_name'] = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();
        $this->result['background_file'] = $this->db->where('type', 'background_file')->get('tbl_settings')->row_array();

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
    }

    /**  Index Page for this controller. */
    public function index() {
        $this->isLoggedIn();
    }

    /*     * This function used to check the user is logged in or not */

    function isLoggedIn() {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            $this->load->view('login', $this->result);
        } else {
            $json_file = 'assets/firebase_config.json';
            if (!file_exists($json_file)) {
                redirect('firebase-configurations');
            } else {
                redirect('dashboard');
            }
        }
    }

    /*     * * This function used to logged in user */

    public function loginMe() {
        $result = $this->Login_model->get_user();

        if ($result) {
            $sessionArray = array(
                'authName' => $result->auth_username,
                'authId' => $result->auth_id,
                'authRole' => $result->role,
                'authStatus' => $result->status,
                'isLoggedIn' => TRUE
            );
            $this->session->set_userdata($sessionArray);
            $this->isLoggedIn();
        } else {
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect('', 'refresh');
        }
        $this->load->view('login', $this->result);
    }

    public function checkOldPass() {
        $oldpass = $this->input->post('oldpass');

        //fetch old password from database
        $aname = $this->session->userdata('authName');
        $row = $this->db->where('auth_username', $aname)->get('tbl_authenticate')->row();
        if (verifyHashedPassword($oldpass, $row->auth_pass)) {
            echo json_encode("True");
        } else {
            echo json_encode("False");
        }
    }

    public function resetpassword() {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        } else {
            if ($this->input->post('btnchange')) {
                if (!has_permissions('create', 'resetpassword')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $newpass = $this->input->post('newpassword');
                    $confirmpass = $this->input->post('confirmpassword');
                    if ($newpass == $confirmpass) {

                        $adminId = $this->session->userdata('authId');

                        $adminpass = getHashedPassword($confirmpass);
                        //change password
                        $this->Login_model->change_password($adminId, $adminpass);
                        $this->session->set_flashdata('success', 'Password Change Successfully..');
                    } else {
                        $this->session->set_flashdata('error', 'New and Confirm Password not Match..');
                    }
                }
                redirect('resetpassword', 'refresh');
            }
            $this->load->view('changePassword', $this->result);
        }
    }

    public function logout() {
        $this->session->unset_userdata('isLoggedIn');
        $this->session->sess_destroy();
        redirect('');
    }

}
