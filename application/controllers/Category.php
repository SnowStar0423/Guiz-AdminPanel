<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        date_default_timezone_set(get_system_timezone());

        $this->category_type = $this->config->item('category_type');

        $this->result['full_logo'] = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
        $this->result['half_logo'] = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
        $this->result['app_name'] = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
    }

    public function index() {
        if (!has_permissions('read', 'categories')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                $type_name = $this->input->post('type');
                $type = $this->category_type[$type_name];
                if (!has_permissions('create', 'categories')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data = $this->Category_model->add_data($type);
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else if($data === 3){
                        $this->session->set_flashdata('error', 'Slug Already Exists');
                    } else if($data === 4){
                        $this->session->set_flashdata('error', 'Slug is required');
                    } else {
                        $this->session->set_flashdata('success', 'Category created successfully.! ');
                    }
                }
                redirect($type_name, 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                $type_name = $this->input->post('type');
                $type = $this->category_type[$type_name];
                if (!has_permissions('update', 'categories')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Category_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else if($data1 === 3){
                        $this->session->set_flashdata('error', 'Slug Already Exists');
                    } else if($data1 === 4){
                        $this->session->set_flashdata('error', 'Slug is required');
                    } else {
                        $this->session->set_flashdata('success', 'Category updated successfully.!');
                    }
                }
                redirect($type_name, 'refresh');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->load->view('category', $this->result);
        }
    }

    public function delete_category() {
        if (!has_permissions('delete', 'categories')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Category_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }

    public function category_order() {
        if (!has_permissions('read', 'category_order')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnaddcategory')) {
                $type_name = $this->input->post('type');
                if (!has_permissions('update', 'category_order')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $this->Category_model->update_order();
                    $this->session->set_flashdata('success', 'Category order update successfully.! ');
                }
                redirect($type_name, 'refresh');
            }
            if ($this->input->post('btnaddsubcategory')) {
                $type_name = $this->input->post('type');
                if (!has_permissions('update', 'category_order')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $this->Subcategory_model->update_order();
                    $this->session->set_flashdata('success', 'Subcategory order update successfully.! ');
                }
                redirect($type_name, 'refresh');
            }
            $this->result['language'] = $this->Language_model->get_data();

            $type_name = $this->uri->segment(1);
            $type = $this->category_type[$type_name];
            $this->result['category'] = $this->Category_model->get_data($type);

            $this->db->select('s.*');
            $this->db->join('tbl_category c', 'c.id=s.maincat_id');
            $this->db->where('s.status', 1)->where('c.type', $type);
            $this->db->order_by('s.row_order', 'ASC');
            $subcategory_list = $this->db->get('tbl_subcategory s')->result();
//            log_message('error', $this->db->last_query());
            $this->result['subcategory'] = $subcategory_list;
            $this->load->view('category_order', $this->result);
        }
    }

    public function get_slug(){
        if (!has_permissions('read', 'categories')) {
            redirect('/', 'refresh');
        }else{
            $this->load->helper('url');
            $category_name = $this->input->post('category_name');
            $editId = $this->input->post('id');

            // Check if the category name is in English and contains only letters, numbers,spaces and hyphens
            if (!preg_match('/^[a-z0-9- ]+$/i', $category_name)) {
                echo '';
                return;
            }

            $slug = url_title($category_name, 'dash', TRUE);

            if($this->Category_model->is_unique_slug($slug,$editId) != 0) {
                $counter = 1;
                $original_slug = $slug;
                while($this->Category_model->is_unique_slug($slug) != 0) {
                    $slug = $original_slug . '-' . $counter;
                    $counter++;
                }
            }
            echo $slug;
        }
    }

    public function verify_slug(){
        if (!has_permissions('read', 'categories')) {
            redirect('/', 'refresh');
        }else{
            $slug = $this->input->post('slug');
            $id = $this->input->post('id');
            $slug = trim($slug);
            if (!preg_match('/^[a-z0-9- ]+$/i', $slug)) {
                echo 3; // Code 
                return false;
            }
            else if($this->Category_model->is_unique_slug($slug,$id) != 0) {
                echo FALSE;
                return false;
            }
            echo TRUE;
            return false;
        }
    }

}

