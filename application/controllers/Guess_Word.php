<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Guess_Word extends CI_Controller {

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

        $this->category_type = $this->config->item('category_type');
        $this->quiz_type = 3;
//        $this->result['subcategory'] = $this->Subcategory_model->get_data();

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
    }

    public function index() {
        if (!has_permissions('read', 'guess_the_word')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'guess_the_word')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data = $this->Guess_Word_model->add_data();
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
                }
                redirect('guess-the-word', 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'guess_the_word')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Guess_Word_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Question updated successfully.!');
                    }
                }
                redirect('guess-the-word', 'refresh');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->result['category'] = $this->Category_model->get_data($this->quiz_type);
            $this->result['language_english'] = $this->Language_model->get_english_lang();  // get the english us and uk language data
            $this->load->view('guess_the_word', $this->result);
        }
    }

    public function delete_guess_word() {
        if (!has_permissions('delete', 'guess_the_word')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Guess_Word_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }

    // public function get_main_category_index(){
    //     if (!has_permissions('read', 'guess_the_word')) {
    //         redirect('/', 'refresh');
    //     } else {
    //         if (!has_permissions('read', 'categories')) {
    //             redirect('/', 'refresh');
    //         } else {
    //             if ($this->input->post('btnadd')) {
    //                 $type_name = $this->input->post('type');
    //                 $type = $this->category_type[$type_name];
    //                 if (!has_permissions('create', 'categories')) {
    //                     $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
    //                 } else {
    //                     $data = $this->Category_model->add_data($type);
    //                     if ($data == FALSE) {
    //                         $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
    //                     } else {
    //                         $this->session->set_flashdata('success', 'Category created successfully.! ');
    //                     }
    //                 }
    //                 redirect($type_name, 'refresh');
    //             }
    //             if ($this->input->post('btnupdate')) {
    //                 $type_name = $this->input->post('type');
    //                 $type = $this->category_type[$type_name];
    //                 if (!has_permissions('update', 'categories')) {
    //                     $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
    //                 } else {
    //                     $data1 = $this->Category_model->update_data();
    //                     if ($data1 == FALSE) {
    //                         $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
    //                     } else {
    //                         $this->session->set_flashdata('success', 'Category updated successfully.!');
    //                     }
    //                 }
    //                 redirect($type_name, 'refresh');
    //             }
    //             $this->result['language'] = $this->Language_model->get_english_lang();
    //             $this->load->view('guess_the_word_main_category', $this->result);
    //         }
    //     }
    // }
    // public function get_sub_category_index(){
    //     if (!has_permissions('read', 'subcategories')) {
    //         redirect('/', 'refresh');
    //     } else {
    //         if ($this->input->post('btnadd')) {
    //             $type_name = $this->input->post('type');
    //             if (!has_permissions('create', 'subcategories')) {
    //                 $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
    //             } else {
    //                 $data = $this->Subcategory_model->add_data();
    //                 if ($data == FALSE) {
    //                     $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
    //                 } else {
    //                     $this->session->set_flashdata('success', 'Subcategory created successfully.! ');
    //                 }
    //             }
    //             redirect($type_name, 'refresh');
    //         }
    //         if ($this->input->post('btnupdate')) {
    //             $type_name = $this->input->post('type');
    //             if (!has_permissions('update', 'subcategories')) {
    //                 $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
    //             } else {
    //                 $data1 = $this->Subcategory_model->update_data();
    //                 if ($data1 == FALSE) {
    //                     $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
    //                 } else {
    //                     $this->session->set_flashdata('success', 'Subcategory updated successfully.!');
    //                 }
    //             }
    //             redirect($type_name, 'refresh');
    //         }
    //         $this->result['language'] = $this->Language_model->get_english_lang();
    //         $type_name = $this->uri->segment(1);
    //         $type = $this->category_type[$type_name];
    //         $this->result['category'] = $this->Category_model->get_data($type);
    //         $this->load->view('guess_the_word_sub_category', $this->result);
    //     }
    // }

//     public function category_order() {
//         if (!has_permissions('read', 'category_order')) {
//             redirect('/', 'refresh');
//         } else {
//             if ($this->input->post('btnaddcategory')) {
//                 $type_name = $this->input->post('type');
//                 if (!has_permissions('update', 'category_order')) {
//                     $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
//                 } else {
//                     $this->Category_model->update_order();
//                     $this->session->set_flashdata('success', 'Category order update successfully.! ');
//                 }
//                 redirect($type_name, 'refresh');
//             }
//             if ($this->input->post('btnaddsubcategory')) {
//                 $type_name = $this->input->post('type');
//                 if (!has_permissions('update', 'category_order')) {
//                     $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
//                 } else {
//                     $this->Subcategory_model->update_order();
//                     $this->session->set_flashdata('success', 'Subcategory order update successfully.! ');
//                 }
//                 redirect($type_name, 'refresh');
//             }
//             $this->result['language'] = $this->Language_model->get_english_lang();

//             $type_name = $this->uri->segment(1);
//             $type = $this->category_type[$type_name];
//             $this->result['category'] = $this->Category_model->get_data($type);

//             $this->db->select('s.*');
//             $this->db->join('tbl_category c', 'c.id=s.maincat_id');
//             $this->db->where('s.status', 1)->where('c.type', $type);
//             $this->db->order_by('s.row_order', 'ASC');
//             $subcategory_list = $this->db->get('tbl_subcategory s')->result();
//             // echo "<pre>";
//             // print_r($subcategory_list);
//             // die;
// //            log_message('error', $this->db->last_query());
//             $this->result['subcategory'] = $subcategory_list;
//             $this->load->view('guess_the_word_category_order', $this->result);
//         }
//     }

}
