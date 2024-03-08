<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Badges extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        date_default_timezone_set(get_system_timezone());

        $this->result['full_logo'] = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
        $this->result['half_logo'] = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
        $this->result['app_name'] = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
        $this->result['notification_title'] = $this->db->where('type', 'notification_title')->get('tbl_settings')->row_array();
        $this->result['notification_body'] = $this->db->where('type', 'notification_body')->get('tbl_settings')->row_array();
    }

    public function index() {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'badges_settings')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Badges_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Badges updated successfully.!');
                    }
                }
                redirect('badges-settings', 'refresh');
            }
            $badges = [
                'dashing_debut',
                'combat_winner',
                'clash_winner',
                'most_wanted_winner',
                'ultimate_player',
                'quiz_warrior',
                'super_sonic',
                'flashback',
                'brainiac',
                'big_thing',
                'elite',
                'thirsty',
                'power_elite',
                'sharing_caring',
                'streak'
            ];
            foreach ($badges as $row) {
                $this->result[$row] = $this->db->where('type', $row)->get('tbl_badges')->row_array();
            }

            $query = $this->db->where_in('type', ['notification_title', 'notification_body'])->get('tbl_settings');
            $badges = [
                'dashing_debut',
                'combat_winner',
                'clash_winner',
                'most_wanted_winner',
                'ultimate_player',
                'quiz_warrior',
                'super_sonic',
                'flashback',
                'brainiac',
                'big_thing',
                'elite',
                'thirsty',
                'power_elite',
                'sharing_caring',
                'streak'
            ];
            foreach ($badges as $row) {
                $this->result[$row] = $this->db->where('type', $row)->get('tbl_badges')->row_array();
            }
            $this->load->view('badges_settings', $this->result);
        }
    }

}
