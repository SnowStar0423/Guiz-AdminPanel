<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Slider_model extends CI_Model {
    
    public function add_data() {

        if (!is_dir(SLIDER_IMG_PATH)) {
            mkdir(SLIDER_IMG_PATH, 0777, TRUE);
        }
        $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
        
        $config['upload_path'] = SLIDER_IMG_PATH;
        $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;


        $config['file_name'] = time();
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('file')) {
            return FALSE;
        } else {
            $data = $this->upload->data();
            $img = $data['file_name'];
            $frm_data = array(
                'language_id' => $language,
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'image' => $img,
            );
            $this->db->insert('tbl_slider', $frm_data);
            return TRUE;
        }
    }
    
    public function update_data() {
        if (!is_dir(SLIDER_IMG_PATH)) {
            mkdir(SLIDER_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');
        
        if (is_language_mode_enabled()) {
            $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
            $data = array('language_id' => $language);
            $this->db->where('id', $id)->update('tbl_slider', $data);            
        }
        
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        
        if ($_FILES['update_file']['name'] == '') {
            $frm_data = array(
                'title' => $title,
                'description' => $description,
            );
            $this->db->where('id', $id)->update('tbl_slider', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = SLIDER_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if (!$this->upload->do_upload('update_file')) {
                return FALSE;
            } else {
                $image_url = $this->input->post('image_url');
                if (file_exists($image_url)) {
                    unlink($image_url);
                }
                
                $data = $this->upload->data();
                $img = $data['file_name'];
                $frm_data = array(
                    'image' => $img,
                    'title' => $title,
                    'description' => $description,
                );
                $this->db->where('id', $id)->update('tbl_slider', $frm_data);
                return TRUE;
            }
        }
    }
    
    public function delete_data($id, $image_url) {        
        //delete image of category
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_slider');      
    }
}
