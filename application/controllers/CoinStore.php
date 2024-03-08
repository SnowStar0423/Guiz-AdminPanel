<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CoinStore extends CI_Controller {

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
        if (!has_permissions('read', 'coin_store_settings')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'coin_store_settings')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data = $this->Coin_Store_model->add_data();
                    if ($data == FALSE) {
                        $failedResponseData = array(
                            'error' => 'Product ID Already Existed',
                            'title' => $this->input->post('title'),
                            'coins' => $this->input->post('coins'),
                            'product_id' => $this->input->post('product_id'),
                            'description' => $this->input->post('description'),
                        );
                        $this->session->set_flashdata($failedResponseData);
                        redirect('coin-store-settings');
                    } else if($data === 2){
                        $failedResponseData = array(
                            'error' => 'File Upload Failed',
                            'title' => $this->input->post('title'),
                            'coins' => $this->input->post('coins'),
                            'product_id' => $this->input->post('product_id'),
                            'description' => $this->input->post('description'),
                        );
                        $this->session->set_flashdata($failedResponseData);
                        redirect('coin-store-settings');
                    } else {
                        $this->session->set_flashdata('success', 'Data created successfully.! ');
                        redirect('coin-store-settings', 'refresh');
                    }
                }

            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'coin_store_settings')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Coin_Store_model->update_data();
                    if ($data1 == FALSE) {
                        $failedResponseData = array(
                            'error' => 'Product ID Already Existed',
                        );
                        $this->session->set_flashdata($failedResponseData);
                        redirect('coin-store-settings');
                    } else if($data1 === 2){
                        $failedResponseData = array(
                            'error' => 'File Upload Failed',
                        );
                        $this->session->set_flashdata($failedResponseData);
                        redirect('coin-store-settings');
                    } else  {
                        $this->session->set_flashdata('success', 'Data updated successfully.! ');
                        redirect('coin-store-settings', 'refresh');
                    }
                }
            }
            if ($this->input->post('btnupdatestatus')) {
                if (!has_permissions('update', 'coin_store_settings')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Coin_Store_model->update_status();
                    $this->session->set_flashdata('success', 'Stauts updated successfully.! ');
                    redirect('coin-store-settings', 'refresh');
                }
            }
            $this->load->view('coin_store_settings', $this->result);
        }
    }

    public function deleteCoinStoreData() {
        if (!has_permissions('delete', 'coin_store_settings')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image = $this->input->post('image_url');
            $this->Coin_Store_model->delete_data($id,$image);
            echo TRUE;
        }
    }

}
