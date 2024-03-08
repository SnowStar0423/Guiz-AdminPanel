<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {

    public function get_all_lang() {
        return $this->db->order_by('language', 'ASC')->get('tbl_languages')->result();
    }

    public function get_data() {
        return $this->db->where('status', 1)->order_by('id', 'DESC')->get('tbl_languages')->result();
    }

    public function get_english_lang(){
        return $this->db->where('(status = 1 AND code = "en")')->or_where('(status = 1 AND code = "en-GB")')->get('tbl_languages')->result();
    }

    public function add_new_data(){
        $language = $this->input->post('language_name');
        $code = $this->input->post('language_code');
    
         // Check if language already exists
        $this->db->where('language', $language);
        $query = $this->db->get('tbl_languages');

        if ($query->num_rows() > 0){
            return array('error' => true, 'message' => 'Name already exists'); // Duplicate language
        }

        // Check if code already exists
        $this->db->where('code', $code);
        $query = $this->db->get('tbl_languages');

        if ($query->num_rows() > 0){
            return array('error' => true, 'message' => 'Code already exists'); // Duplicate language
        }

        // Store Langauge Data
        $frm_data = array(
            'language' => $language,
            'code' => $code,
            'status' => 1,
            'type' => 1
        );
        $this->db->insert('tbl_languages', $frm_data);
        return array('error' => false, 'message' => 'Data inserted successfully');
    }
    

    public function add_data() {
        $language_id = $this->input->post('language_id');
        $data = array(
            'status' => 1,
            'type' => 1
        );
        $this->db->where('id', $language_id)->update('tbl_languages', $data);
    }

    public function update_data() {
        $id = $this->input->post('edit_id');

        $language = $this->input->post('language_name');
        $code = $this->input->post('language_code');
    
        // Check if language already exists
        $this->db->where('language', $language);
        $this->db->where('id !=', $id); 
        $query = $this->db->get('tbl_languages');

        if ($query->num_rows() > 0){
            return array('error' => true, 'message' => 'Name already exists'); // Duplicate language
        }

        // Check if code already exists
        $this->db->where('code', $code);
        $this->db->where('id !=', $id); 
        $query = $this->db->get('tbl_languages');

        if ($query->num_rows() > 0){
            return array('error' => true, 'message' => 'Code already exists'); // Duplicate language
        }

        $data = array('language' => $language,'code' => $code, 'status' => $this->input->post('status'));
        $this->db->where('id', $id)->update('tbl_languages', $data);
        return array('error' => false, 'message' => 'Data udpated successfully');
    }

    public function delete_data($id) {
        $data = array(
            'status' => 0,
            'type' => 0
        );
        $this->db->where('id', $id)->update('tbl_languages', $data);

        //delete category of this language
        $cat = $this->db->where('language_id', $id)->get('tbl_category')->result();
        foreach ($cat as $cat1) {
            if (!empty($cat1->image) && file_exists(CATEGORY_IMG_PATH . $cat1->image)) {
                unlink(CATEGORY_IMG_PATH . $cat1->image);
            }
        }
     
        $this->db->where('language_id', $id)->delete('tbl_category');

        //delete subcategory of this language
        $subcat = $this->db->where('language_id', $id)->get('tbl_subcategory')->result();
        foreach ($subcat as $subcat1) {
            if (!empty($subcat1->image) && file_exists(SUBCATEGORY_IMG_PATH . $subcat1->image)) {
                unlink(SUBCATEGORY_IMG_PATH . $subcat1->image);
            }
        }
        $this->db->where('language_id', $id)->delete('tbl_subcategory');

        //delete question of this language
        $que = $this->db->where('language_id', $id)->get('tbl_question')->result();
        foreach ($que as $que1) {
            if (!empty($que1->image) && file_exists(QUESTION_IMG_PATH . $que1->image)) {
                unlink(QUESTION_IMG_PATH . $que1->image);
            }
        }
        $this->db->where('language_id', $id)->delete('tbl_question');

        //delete fun n learn of this language
        $compre = $this->db->where('language_id', $id)->get('tbl_fun_n_learn')->result();
        foreach ($compre as $compre1) {
            $this->db->where('fun_n_learn_id', $compre1->id)->delete('tbl_fun_n_learn_question');
        }
        $this->db->where('language_id', $id)->delete('tbl_fun_n_learn');

        //delete guess the word of this language
        $guess = $this->db->where('language_id', $id)->get('tbl_guess_the_word')->result();
        foreach ($guess as $guess1) {
            if (!empty($guess1->image) && file_exists(GUESS_WORD_IMG_PATH . $guess1->image)) {
                unlink(GUESS_WORD_IMG_PATH . $guess1->image);
            }
        }
        $this->db->where('language_id', $id)->delete('tbl_guess_the_word');

        //delete daily quiz of this language
        $this->db->where('language_id', $id)->delete('tbl_daily_quiz');

        //delete audio question of this language
        $audio_que = $this->db->where('language_id', $id)->get('tbl_audio_question')->result();
        foreach ($audio_que as $que1) {
            if (!empty($que1->audio) && file_exists(QUESTION_AUDIO_PATH . $que1->audio)) {
                unlink(QUESTION_AUDIO_PATH . $que1->audio);
            }
        }
        $this->db->where('language_id', $id)->delete('tbl_audio_question');

        //delete slider of this language
        $slider = $this->db->where('language_id', $id)->get('tbl_slider')->result();
        foreach ($slider as $s) {
            if (!empty($s->image) && file_exists(SLIDER_IMG_PATH . $s->image)) {
                unlink(SLIDER_IMG_PATH . $s->image);
            }
        }
        $this->db->where('language_id', $id)->delete('tbl_slider');
    }

}

?>