<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maths_Question extends CI_Controller {

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

        $this->quiz_type = 5;

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();

        $this->result['language'] = $this->Language_model->get_data();
        $this->result['category'] = $this->Category_model->get_data($this->quiz_type);
//        $this->result['subcategory'] = $this->Subcategory_model->get_data();
    }

    public function index() {
        if (!has_permissions('read', 'maths_questions')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'maths_questions')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data = $this->Maths_model->add_data();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Question created successfully.! ');
                    }
                    $type = $this->uri->segment(1);
                    $setData["$type"] = [
                        'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
                        'category' => $this->input->post('category'),
                        'subcategory' => $this->input->post('subcategory')
                    ];
                    $this->session->set_userdata($setData);
                    redirect('create-maths-questions', 'refresh');
                }
            }
            $this->load->view('maths_question_create', $this->result);
        }
    }

    public function edit_questions($id) {
        if (!has_permissions('read', 'maths_questions')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'maths_questions')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Maths_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Question updated successfully.!');
                    }
                    redirect('manage-maths-questions', 'refresh');
                }
            }
            $this->result['data'] = $this->Maths_model->get_data($id);
            $this->load->view('maths_question_create', $this->result);
        }
    }

    public function manage_questions() {
        if (!has_permissions('read', 'maths_questions')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'maths_questions')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Maths_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Question updated successfully.!');
                    }
                    redirect('manage-maths-questions', 'refresh');
                }
            }
            $this->load->view('maths_question_manage', $this->result);
        }
    }

    public function delete_questions() {
        if (!has_permissions('delete', 'maths_questions')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Maths_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }

}

?>