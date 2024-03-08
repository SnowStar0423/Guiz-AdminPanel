<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Audio_model extends CI_Model {

    public function get_data() {
        return $this->db->order_by('id', 'DESC')->get('tbl_audio_question')->result();
    }

    public function add_audio_data() {
        if (!is_dir(QUESTION_AUDIO_PATH)) {
            mkdir(QUESTION_AUDIO_PATH, 0777, TRUE);
        }

        $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
        $question = $this->input->post('question');
        $category = $this->input->post('category');
        $subcategory = ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0;
        $question_type = $this->input->post('question_type');
        $audio_type = $this->input->post('audio_type');
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
                'audio_type' => $audio_type,
                'audio' => $this->input->post('audio_type_url'),
                'optiona' => $a,
                'optionb' => $b,
                'optionc' => $c,
                'optiond' => $d,
                'optione' => $e,
                'answer' => $answer,
                'note' => $note
            );
            $this->db->insert('tbl_audio_question', $frm_data);

            return TRUE;
        } else {
            $config['upload_path'] = QUESTION_AUDIO_PATH;
            $config['allowed_types'] = AUDIO_ALLOWED_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                return FALSE;
            } else {
                $data = $this->upload->data();
                $audio = $data['file_name'];

                $frm_data = array(
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'language_id' => $language,
                    'audio_type' => $audio_type,
                    'audio' => $audio,
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
                $this->db->insert('tbl_audio_question', $frm_data);
                return TRUE;
            }
        }
    }

    public function update_data() {
        if (!is_dir(QUESTION_AUDIO_PATH)) {
            mkdir(QUESTION_AUDIO_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');

        if (is_language_mode_enabled()) {
            $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
            $data = array('language_id' => $language);
            $this->db->where('id', $id)->update('tbl_audio_question', $data);
        }

        $question = $this->input->post('question');
        $category = $this->input->post('category');
        $subcategory = ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0;
        $question_type = $this->input->post('edit_question_type');
        $audio_type = $this->input->post('audio_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');
        $note = $this->input->post('note');

        $frm_data = array(
            'category' => $category,
            'subcategory' => $subcategory,
            'audio_type' => $audio_type,
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

        if ($_FILES['update_file']['name'] != '' && $audio_type == '2') {

            $config['upload_path'] = QUESTION_AUDIO_PATH;
            $config['allowed_types'] = AUDIO_ALLOWED_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('update_file')) {
                return FALSE;
            } else {
                $audio_url = $this->input->post('audio_url');
                if (file_exists($audio_url)) {
                    unlink($audio_url);
                }

                $data = $this->upload->data();
                $audio = $data['file_name'];
                $frm_data['audio'] = $audio;
                $this->db->where('id', $id)->update('tbl_audio_question', $frm_data);
                return TRUE;
            }
        } else {
            if ($audio_type == '1') {
                $frm_data['audio'] = $this->input->post('audio_type_url');
            }
            $this->db->where('id', $id)->update('tbl_audio_question', $frm_data);
            return TRUE;
        }
    }

    public function delete_data($id, $audio_url) {
        if (file_exists($audio_url)) {
            unlink($audio_url);
        }
        $this->db->where('id', $id)->delete('tbl_audio_question');
        //remove bookmark question
        $this->db->where('question_id', $id)->delete('tbl_bookmark');
    }

}

?>