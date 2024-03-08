<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maths_model extends CI_Model {

    public function get_data($id = 0) {
        if($id != 0){
            $this->db->where('id', $id);
        }
        return $this->db->order_by('id', 'DESC')->get('tbl_maths_question')->result();
    }

    public function add_data() {
        if (!is_dir(MATHS_QUESTION_IMG_PATH)) {
            mkdir(MATHS_QUESTION_IMG_PATH, 0777, TRUE);
        }
        $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
        $question = $this->input->post('question');
        $category = $this->input->post('category');
        $subcategory = ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0;
        $question_type = $this->input->post('question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');
        $note = $this->input->post('note');

        if ($_FILES['file']['name'] == '') {
            $frm_data = array(
                'category' => $category,
                'subcategory' => $subcategory,
                'language_id' => $language,
                'question' => $question,
                'question_type' => $question_type,
                'optiona' => $a,
                'optionb' => $b,
                'optionc' => $c,
                'optiond' => $d,
                'optione' => $e,
                'answer' => $answer,
                'note' => $note
            );
            $this->db->insert('tbl_maths_question', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = MATHS_QUESTION_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                return FALSE;
            } else {
                $data = $this->upload->data();
                $img = $data['file_name'];
                $frm_data = array(
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'language_id' => $language,
                    'image' => $img,
                    'question' => $question,
                    'question_type' => $question_type,
                    'optiona' => $a,
                    'optionb' => $b,
                    'optionc' => $c,
                    'optiond' => $d,
                    'optione' => $e,
                    'answer' => $answer,
                    'note' => $note
                );
                $this->db->insert('tbl_maths_question', $frm_data);
                return TRUE;
            }
        }
    }

    public function update_data() {
        if (!is_dir(MATHS_QUESTION_IMG_PATH)) {
            mkdir(MATHS_QUESTION_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');

        if (is_language_mode_enabled()) {
            $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
            $data = array('language_id' => $language);
            $this->db->where('id', $id)->update('tbl_maths_question', $data);
        }

        $question = $this->input->post('question');
        $category = $this->input->post('category');
        $subcategory = ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0;
        $question_type = $this->input->post('question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');
        $note = $this->input->post('note');

        if ($_FILES['file']['name'] == '') {
            $frm_data = array(
                'category' => $category,
                'subcategory' => $subcategory,
                'question' => $question,
                'question_type' => $question_type,
                'optiona' => $a,
                'optionb' => $b,
                'optionc' => $c,
                'optiond' => $d,
                'optione' => $e,
                'answer' => $answer,
                'note' => $note
            );
            $this->db->where('id', $id)->update('tbl_maths_question', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = MATHS_QUESTION_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                return FALSE;
            } else {
                $image_url = $this->input->post('image_url');
                if (file_exists($image_url)) {
                    unlink($image_url);
                }

                $data = $this->upload->data();
                $img = $data['file_name'];
                $frm_data = array(
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'image' => $img,
                    'question' => $question,
                    'question_type' => $question_type,
                    'optiona' => $a,
                    'optionb' => $b,
                    'optionc' => $c,
                    'optiond' => $d,
                    'optione' => $e,
                    'answer' => $answer,
                    'note' => $note
                );
                $this->db->where('id', $id)->update('tbl_maths_question', $frm_data);
                return TRUE;
            }
        }
    }

    public function delete_data($id, $image_url) {
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_maths_question');
    }

}

?>