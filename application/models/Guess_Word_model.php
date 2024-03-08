<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Guess_Word_model extends CI_Model {

    public function add_data() {
        if (!is_dir(GUESS_WORD_IMG_PATH)) {
            mkdir(GUESS_WORD_IMG_PATH, 0777, TRUE);
        }
        $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
        $category = $this->input->post('category');
        $subcategory = ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0;
        $question = $this->input->post('question');
        $answer = $this->input->post('answer');

        if ($_FILES['file']['name'] == '') {
            $frm_data = array(
                'language_id' => $language,
                'category' => $category,
                'subcategory' => $subcategory,
                'question' => $question,
                'answer' => $answer
            );
            $this->db->insert('tbl_guess_the_word', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = GUESS_WORD_IMG_PATH;
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
                    'language_id' => $language,
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'image' => $img,
                    'question' => $question,
                    'answer' => $answer
                );
                $this->db->insert('tbl_guess_the_word', $frm_data);
                return TRUE;
            }
        }
    }

    public function update_data() {
        if (!is_dir(GUESS_WORD_IMG_PATH)) {
            mkdir(GUESS_WORD_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');

        if (is_language_mode_enabled()) {
            $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
            $data = array('language_id' => $language);
            $this->db->where('id', $id)->update('tbl_guess_the_word', $data);
        }

        $question = $this->input->post('question');
        $answer = $this->input->post('answer');
        $category = $this->input->post('category');
        $subcategory = ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0;

        if ($_FILES['update_file']['name'] == '') {
            $frm_data = array(
                'category' => $category,
                'subcategory' => $subcategory,
                'question' => $question,
                'answer' => $answer
            );
            $this->db->where('id', $id)->update('tbl_guess_the_word', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = GUESS_WORD_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_TYPES;
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
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'image' => $img,
                    'question' => $question,
                    'answer' => $answer,
                );
                $this->db->where('id', $id)->update('tbl_guess_the_word', $frm_data);
                return TRUE;
            }
        }
    }

    public function delete_data($id, $image_url) {
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_guess_the_word');
        //remove bookmark question
        $this->db->where('question_id', $id)->delete('tbl_bookmark');
    }

}

?>