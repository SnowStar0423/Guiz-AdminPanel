<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set(get_system_timezone());

        $this->result['full_logo'] = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
        $this->result['half_logo'] = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
        $this->result['app_name'] = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
    }

    public function index() {
        if (!has_permissions('read', 'sliders')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {


                if (!has_permissions('create', 'sliders')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data = $this->Slider_model->add_data();

                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_PNG_JPG_SVG_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Slider created successfully.! ');
                    }
                }

                // redirect('sliders', 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'sliders')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Slider_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_PNG_JPG_SVG_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Slider updated successfully.!');
                    }
                }
                redirect('sliders', 'refresh');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->load->view('sliders', $this->result);
        }
    }

    public function delete_sliders() {
        if (!has_permissions('delete', 'sliders')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Slider_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }

}
