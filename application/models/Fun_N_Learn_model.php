<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fun_N_Learn_model extends CI_Model {

    public function get_data() {
        return $this->db->order_by('id', 'DESC')->get('tbl_fun_n_learn')->result();
    }

    public function add_data() {
        $data = array(
            'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
            'category' => $this->input->post('category'),
            'subcategory' => ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0,
            'title' => $this->input->post('title'),
            'detail' => $this->input->post('detail'),
            'status' => 0
        );
        $this->db->insert('tbl_fun_n_learn', $data);
    }

    public function update_data() {
        $id = $this->input->post('edit_id');
        $data = array(
            'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
            'category' => $this->input->post('category'),
            'subcategory' => ($this->input->post('subcategory')) ? $this->input->post('subcategory') : 0,
            'title' => $this->input->post('title'),
            'detail' => $this->input->post('detail')
        );
        $this->db->where('id', $id)->update('tbl_fun_n_learn', $data);
    }

    public function delete_data($id) {
        $this->db->where('fun_n_learn_id', $id)->delete('tbl_fun_n_learn_question');
        $this->db->where('id', $id)->delete('tbl_fun_n_learn');
    }

    public function update_fun_n_learn_status() {
        $id = $this->input->post('update_id');
        $data = array(
            'status' => $this->input->post('status')
        );
        $this->db->where('id', $id)->update('tbl_fun_n_learn', $data);
    }

    public function add_fun_n_learn_question() {
        $fun_n_learn_id = $this->input->post('fun_n_learn_id');
        $question = $this->input->post('question');
        $question_type = $this->input->post('question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');

        $frm_data = array(
            'fun_n_learn_id' => $fun_n_learn_id,
            'question' => $question,
            'question_type' => $question_type,
            'optiona' => $a,
            'optionb' => $b,
            'optionc' => $c,
            'optiond' => $d,
            'optione' => $e,
            'answer' => $answer,
        );
        $this->db->insert('tbl_fun_n_learn_question', $frm_data);
    }

    public function update_fun_n_learn_question() {
        $id = $this->input->post('edit_id');
        $question = $this->input->post('question');
        $question_type = $this->input->post('edit_question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');

        $frm_data = array(
            'question' => $question,
            'question_type' => $question_type,
            'optiona' => $a,
            'optionb' => $b,
            'optionc' => $c,
            'optiond' => $d,
            'optione' => $e,
            'answer' => $answer,
        );
        $this->db->where('id', $id)->update('tbl_fun_n_learn_question', $frm_data);
    }

    public function delete_fun_n_learn_questions($id) {
        $this->db->where('id', $id)->delete('tbl_fun_n_learn_question');
    }

}

?>