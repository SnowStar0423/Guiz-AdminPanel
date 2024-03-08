<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_Languages_model extends CI_Model {
    public function get_data() {
        return $this->db->order_by('id', 'DESC')->get('tbl_upload_languages')->result();
    }
    public function add_data() {
        if (!is_dir(LANGUAGE_FILE_PATH)) {
            mkdir(LANGUAGE_FILE_PATH, 0777, TRUE);
        }
        $language_data = array(
            'name' => $this->input->post('language_name'),
        );
        if (isset($_FILES['file']) && $_FILES['file']['name'] != ''){
            $config['upload_path'] = LANGUAGE_FILE_PATH;
            $config['allowed_types'] = LANGUAGE_FILE_ALLOWED_TYPES;
            $config['file_name'] = $this->input->post('language_name').'-'.time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                return FALSE;
            }else{
                $data = $this->upload->data();
                $language_data['file'] = $data['file_name'];
            }
        }
        $this->db->insert('tbl_upload_languages', $language_data);
    }
    public function update_data(){
        $id = $this->input->post('edit_id');
        $data = array(
            'name' => $this->input->post('update_name')
        );
        if (isset($_FILES['update_file']) && $_FILES['update_file']['name'] != ''){
            $config['upload_path'] = LANGUAGE_FILE_PATH;
            $config['allowed_types'] = LANGUAGE_FILE_ALLOWED_TYPES;
            $config['file_name'] = $this->input->post('update_name').'-'.time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('update_file')) {
                return FALSE;
            }else{
                $old_file_path = $this->input->post('file_url');
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
                $file_data = $this->upload->data();
                $data['file'] = $file_data['file_name'];
            }
        }
        $this->db->where('id', $id)->update('tbl_upload_languages', $data);
    }
    public function delete_data($id, $file_url) {
        if (file_exists($file_url)) {
            unlink($file_url);
        }
        $this->db->where('id', $id)->delete('tbl_upload_languages');
    }
}

?>