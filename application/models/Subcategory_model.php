<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory_model extends CI_Model {

    public function get_data() {
        return $this->db->where('status', 1)->order_by('row_order', 'ASC')->get('tbl_subcategory')->result();
    }

    public function update_order() {
        $id_ary = explode(",", $this->input->post('row_order1'));
        for ($i = 0; $i < count($id_ary); $i++) {
            $this->db->query("UPDATE tbl_subcategory SET row_order='$i' WHERE id='$id_ary[$i]'");
        }
    }

    public function add_data() {
        if (!is_dir(SUBCATEGORY_IMG_PATH)) {
            mkdir(SUBCATEGORY_IMG_PATH, 0777, TRUE);
        }
        $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;

        if(!$this->input->post('slug')){
            return 4;
        }

        $slug = $this->input->post('slug');
        $slug = trim($slug);
        $slug = url_title($slug, 'dash', TRUE);
        if($this->is_unique_slug($slug) != 0) {
            return 3;
        }

        if ($_FILES['file']['name'] == '') {
            $frm_data = array(
                'language_id' => $language,
                'maincat_id' => $this->input->post('maincat_id'),
                'subcategory_name' => $this->input->post('name'),
                'slug' => $slug,
                'image' => '',
                'status' => 1,
                'is_premium' => $this->input->post('is_premium'),
                'coins' => $this->input->post('is_premium') ? $this->input->post('coins') : 0,
                'row_order' => 0
            );
            $this->db->insert('tbl_subcategory', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = SUBCATEGORY_IMG_PATH;
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
                    'maincat_id' => $this->input->post('maincat_id'),
                    'subcategory_name' => $this->input->post('name'),
                    'slug' => $slug,
                    'image' => $img,
                    'status' => 1,
                    'is_premium' => $this->input->post('is_premium'),
                    'coins' => $this->input->post('is_premium') ? $this->input->post('coins') : 0,
                    'row_order' => 0
                );
                $this->db->insert('tbl_subcategory', $frm_data);
                return TRUE;
            }
        }
    }

    public function update_data() {
        if (!is_dir(SUBCATEGORY_IMG_PATH)) {
            mkdir(SUBCATEGORY_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');
        
        if(!$this->input->post('slug')){
            return 4;
        }

        $slug = $this->input->post('slug');
        $slug = trim($slug);
        $slug = url_title($slug, 'dash', TRUE);
        if($this->is_unique_slug($slug,$id) != 0) {
            return 3;
        }

        if (is_language_mode_enabled()) {
            $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
            $data = array('language_id' => $language);
            $this->db->where('id', $id)->update('tbl_subcategory', $data);

            $this->db->where('subcategory', $id)->update('tbl_question', $data);
            $this->db->where('subcategory', $id)->update('tbl_fun_n_learn', $data);
            $this->db->where('subcategory', $id)->update('tbl_guess_the_word', $data);
            $this->db->where('subcategory', $id)->update('tbl_audio_question', $data);
            $this->db->where('subcategory', $id)->update('tbl_maths_question', $data);
        }

        $maincat_id = $this->input->post('maincat_id');
        $name = $this->input->post('name');
        $status = $this->input->post('status');
        $data1 = array('category' => $maincat_id);
        $this->db->where('subcategory', $id)->update('tbl_question', $data1);
        $this->db->where('subcategory', $id)->update('tbl_fun_n_learn', $data1);
        $this->db->where('subcategory', $id)->update('tbl_guess_the_word', $data1);
        $this->db->where('subcategory', $id)->update('tbl_audio_question', $data1);
        $this->db->where('subcategory', $id)->update('tbl_maths_question', $data1);

        if ($_FILES['update_file']['name'] == '') {
            $frm_data = array(
                'maincat_id' => $maincat_id,
                'subcategory_name' => $name,
                'slug' => $slug,
                'status' => $status,
                'is_premium' => $this->input->post('edit_is_premium'),
                'coins' => $this->input->post('edit_is_premium') ? $this->input->post('edit_coins') : 0,
            );
            $this->db->where('id', $id)->update('tbl_subcategory', $frm_data);

            return TRUE;
        } else {
            $config['upload_path'] = SUBCATEGORY_IMG_PATH;
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
                    'maincat_id' => $maincat_id,
                    'subcategory_name' => $name,
                    'slug' => $slug,
                    'status' => $status,
                    'image' => $img,
                );
                $this->db->where('id', $id)->update('tbl_subcategory', $frm_data);

                return TRUE;
            }
        }
    }

    public function delete_data($id, $image_url) {
        //delete question of this subcategory
        $que = $this->db->where('subcategory', $id)->get('tbl_question')->result();
        foreach ($que as $value) {
            if (!empty($value->image) && file_exists(QUESTION_IMG_PATH . $value->image)) {
                unlink(QUESTION_IMG_PATH . $value->image);
            }
        }
        $this->db->where('subcategory', $id)->delete('tbl_question');

        //delete image of this subcategory
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_subcategory');

        //delete fun n learn of this subcategory
        $compre = $this->db->where('subcategory', $id)->get('tbl_fun_n_learn')->result();
        foreach ($compre as $compre1) {
            $this->db->where('fun_n_learn_id', $compre1->id)->delete('tbl_fun_n_learn_question');
        }
        $this->db->where('subcategory', $id)->delete('tbl_fun_n_learn');

        //delete guess the word of this subcategory
        $guess = $this->db->where('subcategory', $id)->get('tbl_guess_the_word')->result();
        foreach ($guess as $guess1) {
            if (!empty($guess1->image) && file_exists(GUESS_WORD_IMG_PATH . $guess1->image)) {
                unlink(GUESS_WORD_IMG_PATH . $guess1->image);
            }
        }
        $this->db->where('subcategory', $id)->delete('tbl_guess_the_word');

        //delete audio question of this subcategory
        $audio_que = $this->db->where('subcategory', $id)->get('tbl_audio_question')->result();
        foreach ($audio_que as $value) {
            if (!empty($value->audio) && file_exists(QUESTION_AUDIO_PATH . $value->audio)) {
                unlink(QUESTION_AUDIO_PATH . $value->audio);
            }
        }
        $this->db->where('subcategory', $id)->delete('tbl_audio_question');

        //delete maths question of this subcategory
        $maths_que = $this->db->where('subcategory', $id)->get('tbl_maths_question')->result();
        foreach ($maths_que as $que1) {
            if (!empty($que1->image) && file_exists(MATHS_QUESTION_IMG_PATH . $que1->image)) {
                unlink(MATHS_QUESTION_IMG_PATH . $que1->image);
            }
        }
        $this->db->where('subcategory', $id)->delete('tbl_maths_question');
    }

    public function is_unique_slug($slug,$id = null) {
        if($id != null){
            $this->db->where('slug', $slug)->where('id !=',$id);
        }else{
            $this->db->where('slug', $slug);
        }
        $query = $this->db->get('tbl_subcategory');
        return $query->num_rows() == 0 ? 0 : 1;
    }

}

?>
