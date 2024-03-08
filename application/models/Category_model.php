<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function get_data($type) {
        return $this->db->where('type', $type)->order_by('row_order', 'ASC')->get('tbl_category')->result();
    }

    public function update_order() {
        $id_ary = explode(",", $this->input->post('row_order'));
        for ($i = 0; $i < count($id_ary); $i++) {
            $this->db->query("UPDATE tbl_category SET row_order='$i' WHERE id='$id_ary[$i]'");
        }
    }

    public function add_data($type) {
        if (!is_dir(CATEGORY_IMG_PATH)) {
            mkdir(CATEGORY_IMG_PATH, 0777, TRUE);
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
                'category_name' => $this->input->post('name'),
                'slug' => $slug,
                'type' => $type,
                'is_premium' => $this->input->post('is_premium'),
                'coins' => $this->input->post('is_premium') ? $this->input->post('coins') : 0,
                'image' => '',
                'row_order' => 0
            );
            $this->db->insert('tbl_category', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = CATEGORY_IMG_PATH;
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
                    'category_name' => $this->input->post('name'),
                    'slug' => $slug,
                    'type' => $type,
                    'is_premium' => $this->input->post('is_premium'),
                    'coins' => $this->input->post('is_premium') ? $this->input->post('coins') : 0,
                    'image' => $img,
                    'row_order' => 0
                );
                $this->db->insert('tbl_category', $frm_data);
                return TRUE;
            }
        }
    }

    public function update_data() {
        if (!is_dir(CATEGORY_IMG_PATH)) {
            mkdir(CATEGORY_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');

        if (is_language_mode_enabled()) {
            $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
            $data = array('language_id' => $language);
            $this->db->where('id', $id)->update('tbl_category', $data);

            $this->db->where('maincat_id', $id)->update('tbl_subcategory', $data);
            $this->db->where('category', $id)->update('tbl_question', $data);
            $this->db->where('category', $id)->update('tbl_guess_the_word', $data);
            $this->db->where('category', $id)->update('tbl_fun_n_learn', $data);
            $this->db->where('category', $id)->update('tbl_audio_question', $data);
            $this->db->where('category', $id)->update('tbl_maths_question', $data);
        }

        $name = $this->input->post('name');
        
        if(!$this->input->post('edit_slug')){
            return 4;
        }
        
        $slug = $this->input->post('edit_slug');
        $slug = trim($slug);
        $slug = url_title($slug, 'dash', TRUE);

        if($this->is_unique_slug($slug,$id) != 0) {
            return 3;
        }
        if ($_FILES['update_file']['name'] == '') {
            $frm_data = array(
                'category_name' => $name,
                'slug' => $slug,
                'is_premium' => $this->input->post('edit_is_premium'),
                'coins' => $this->input->post('edit_is_premium') ? $this->input->post('edit_coins') : 0,
            );
            $this->db->where('id', $id)->update('tbl_category', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = CATEGORY_IMG_PATH;
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
                    'category_name' => $name,
                    'slug' => $slug,
                    'image' => $img,
                    'is_premium' => $this->input->post('edit_is_premium'),
                    'coins' => $this->input->post('edit_is_premium') ? $this->input->post('edit_coins') : 0,
                );
                $this->db->where('id', $id)->update('tbl_category', $frm_data);
                return TRUE;
            }
        }
    }

    public function delete_data($id, $image_url) {
        //delete subcategory of this category
        $subcat = $this->db->where('maincat_id', $id)->get('tbl_subcategory')->result();
        foreach ($subcat as $value) {
            if (!empty($value->image) && file_exists(SUBCATEGORY_IMG_PATH . $value->image)) {
                unlink(SUBCATEGORY_IMG_PATH . $value->image);
            }
        }
        $this->db->where('maincat_id', $id)->delete('tbl_subcategory');

        //delete question of this category
        $que = $this->db->where('category', $id)->get('tbl_question')->result();
        foreach ($que as $que1) {
            if (!empty($que1->image) && file_exists(QUESTION_IMG_PATH . $que1->image)) {
                unlink(QUESTION_IMG_PATH . $que1->image);
            }
        }
        $this->db->where('category', $id)->delete('tbl_question');

        //delete image of category
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_category');

        //delete fun n learn of this category
        $compre = $this->db->where('category', $id)->get('tbl_fun_n_learn')->result();
        foreach ($compre as $compre1) {
            $this->db->where('fun_n_learn_id', $compre1->id)->delete('tbl_fun_n_learn_question');
        }
        $this->db->where('category', $id)->delete('tbl_fun_n_learn');

        //delete guess the word of this category
        $guess = $this->db->where('category', $id)->get('tbl_guess_the_word')->result();
        foreach ($guess as $guess1) {
            if (!empty($guess1->image) && file_exists(GUESS_WORD_IMG_PATH . $guess1->image)) {
                unlink(GUESS_WORD_IMG_PATH . $guess1->image);
            }
        }
        $this->db->where('category', $id)->delete('tbl_guess_the_word');

        //delete audio question of this category
        $audio_que = $this->db->where('category', $id)->get('tbl_audio_question')->result();
        foreach ($audio_que as $que1) {
            if (!empty($que1->audio) && file_exists(QUESTION_AUDIO_PATH . $que1->audio)) {
                unlink(QUESTION_AUDIO_PATH . $que1->audio);
            }
        }
        $this->db->where('category', $id)->delete('tbl_audio_question');

        //delete maths question of this category
        $maths_que = $this->db->where('category', $id)->get('tbl_maths_question')->result();
        foreach ($maths_que as $que2) {
            if (!empty($que2->image) && file_exists(MATHS_QUESTION_IMG_PATH . $que2->image)) {
                unlink(MATHS_QUESTION_IMG_PATH . $que2->image);
            }
        }
        $this->db->where('category', $id)->delete('tbl_maths_question');
    }

    public function is_unique_slug($slug,$id = null) {
        if($id != null){
            $this->db->where('slug', $slug)->where('id !=',$id);
        }else{
            $this->db->where('slug', $slug);
        }
        $query = $this->db->get('tbl_category');
        return $query->num_rows() == 0 ? 0 : 1;
    }

}

?>
