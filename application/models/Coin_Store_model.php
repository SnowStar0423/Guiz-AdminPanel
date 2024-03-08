<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Coin_Store_model extends CI_Model {
    
    public function add_data() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_id', 'Product ID', 'is_unique[tbl_coin_store.product_id]');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $frm_data = array(
                'title' => $this->input->post('title'),
                'coins' => $this->input->post('coins'),
                'product_id' => $this->input->post('product_id'),
                'description' => $this->input->post('description'),
            );
            if (isset($_FILES['file']) && $_FILES['file']['name'] != '' && !empty($_FILES['file'])){
                if (!is_dir(COIN_STORE_IMG_PATH)) {
                    mkdir(COIN_STORE_IMG_PATH, 0777, TRUE);
                }
                $config['upload_path'] = COIN_STORE_IMG_PATH;
                $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
                $config['file_name'] = time();
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if (!$this->upload->do_upload('file')) {
                    return 2; // if any error then pass 2 as code 
                } else {
                    $data = $this->upload->data();
                    $frm_data['image'] = $data['file_name'];
                }
            }
            // Insert data into database
            $this->db->insert('tbl_coin_store', $frm_data);
            return TRUE;
        }
    }
    
    public function update_data() {
        $id = $this->input->post('edit_id');
        $product_id = $this->input->post('product_id');
        $validationResult = $this->is_unique_except($product_id,$id);
        if ($validationResult == FALSE) {
            return FALSE;
        } else {
            // Update data into database    
            $title = $this->input->post('title');
            $coins = $this->input->post('coins');
            $description = $this->input->post('description');
            
            $frm_data = array(
                'title' => $title,
                'coins' => $coins,
                'product_id' => $product_id,
                'description' => $description,
            );
            if (isset($_FILES['edit_file']) && $_FILES['edit_file']['name'] != '' && !empty($_FILES['edit_file'])){
                if (!is_dir(COIN_STORE_IMG_PATH)) {
                    mkdir(COIN_STORE_IMG_PATH, 0777, TRUE);
                }
                $config['upload_path'] = COIN_STORE_IMG_PATH;
                $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
                $config['file_name'] = time();
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if (!$this->upload->do_upload('edit_file')) {
                    return 2; // if any error then pass 2 as code 
                } else {
                    $image_url = $this->input->post('image_url');
                    if (file_exists($image_url)) {
                        unlink($image_url);
                    }

                    $data = $this->upload->data();
                    $frm_data['image'] = $data['file_name'];
                }
            }
            $this->db->where('id', $id)->update('tbl_coin_store', $frm_data);
            return TRUE;
        }
    }
    
    public function delete_data($id,$image_url) {
        //delete image of category
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_coin_store');
    }

    public function is_unique_except($str, $id) {
        // Check if product_id is unique except for current record
        $query = $this->db->where('product_id', $str)->where('id !=', $id)->get('tbl_coin_store');
        if ($query->num_rows() > 0) {
            // Product ID already exists
            $this->form_validation->set_message('is_unique_except', 'Product ID Exists');
            return FALSE;
        } else {
            // Product ID is unique
            return TRUE;
        }
    }

    public function update_status(){
        $id = $this->input->post('edit_id');
        $status = $this->input->post('status');
        $form_data = array(
            'status' => $status,
        );
        $this->db->where('id', $id)->update('tbl_coin_store', $form_data);
        return TRUE;
    }
}
