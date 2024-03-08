<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {

    public function get_data($id) {
        return $this->db->where('id',$id)->order_by('id', 'DESC')->get('tbl_question')->result();
    }

    public function import_data() {
        $name = explode(".", $_FILES['file']['name']);
        $file_extension = end($name);

        if ($_FILES['file']['tmp_name'] != "" && $file_extension == "csv") {
            $filename = $_FILES['file']['tmp_name'];
            $file = fopen($filename, "r");
            $count = $count1 = 0;

            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
                if (count($emapData) > 2) {
                    $emapData[0] = $emapData[0]; //category
                    $emapData[1] = (empty($emapData[1])) ? "0" : $emapData[1]; //subcategory
                    $emapData[2] = (is_language_mode_enabled()) ? $emapData[2] : "0";   //language_id
                    $emapData[3] = trim($emapData[3]);   //question_type
                    $emapData[4] = $emapData[4];     //question
                    $emapData[5] = $emapData[5];    // optiona
                    $emapData[6] = $emapData[6];    // optionb
                    $emapData[7] = $emapData[7];    // optionc
                    $emapData[8] = $emapData[8];    // optiond
                    $emapData[9] = (empty($emapData[9])) ? "" : $emapData[9];  // optione
                    $emapData[10] = trim(strtolower($emapData[10]));  //answer
                    $emapData[11] = $emapData[11];       //level
                    $emapData[12] = $emapData[12];      // note
                    $count++;
                    if ($count > 1) {
                        if ($emapData[3] == '1') {
                            if ($emapData[0] != '' && $emapData[1] != '' && $emapData[2] != '' && !empty($emapData[3]) && $emapData[4] != '' && $emapData[5] != '' && $emapData[6] != '' && $emapData[7] != '' && $emapData[8] != '' && !empty($emapData[10]) && $emapData[11] != '') {
                                $empty_value_found = true;
                            } else {
                                $empty_value_found = false;
                                echo 'Please Check ' . $count . ' row';
                                break;
                            }
                        } else if ($emapData[3] == '2') {
                            if ($emapData[0] != '' && $emapData[1] != '' && $emapData[2] != '' && !empty($emapData[3]) && $emapData[4] != '' && $emapData[5] != '' && $emapData[6] != '' && !empty($emapData[10]) && $emapData[11] != '') {
                                $empty_value_found = true;
                            } else {
                                $empty_value_found = false;
                                echo 'Please Check ' . $count . ' row';
                                break;
                            }
                        } else {
                            $empty_value_found = false;
                            break;
                        }
                    }
                }
            }
            fclose($file);
            if ($empty_value_found == TRUE) {
                $file = fopen($filename, "r");
                while (($emapData1 = fgetcsv($file, 10000, ",")) !== FALSE) {
                    if (count($emapData1) > 2) {
                        $emapData1[0] = $emapData1[0]; //category
                        $emapData1[1] = (empty($emapData1[1])) ? "0" : $emapData1[1]; //subcategory
                        $emapData1[2] = (is_language_mode_enabled()) ? $emapData1[2] : "0";   //language_id
                        $emapData1[3] = trim($emapData1[3]);   //question_type
                        $emapData1[4] = $emapData1[4];     //question
                        $emapData1[5] = $emapData1[5];    // optiona
                        $emapData1[6] = $emapData1[6];    // optionb
                        $emapData1[7] = $emapData1[7];    // optionc
                        $emapData1[8] = $emapData1[8];    // optiond
                        $emapData1[9] = (empty($emapData1[9])) ? "" : $emapData1[9];  // optione
                        $emapData1[10] = trim(strtolower($emapData1[10]));  //answer
                        $emapData1[11] = $emapData1[11];       //level
                        $emapData1[12] = $emapData1[12];      // note
                        $count1++;
                        if ($count1 > 1) {
                            if (count($emapData1) > 2) {
                                $frm_data = array(
                                    'category' => $emapData1[0],
                                    'subcategory' => $emapData1[1],
                                    'language_id' => $emapData1[2],
                                    'image' => '',
                                    'question' => $emapData1[4],
                                    'question_type' => $emapData1[3],
                                    'optiona' => $emapData1[5],
                                    'optionb' => $emapData1[6],
                                    'optionc' => $emapData1[7],
                                    'optiond' => $emapData1[8],
                                    'optione' => $emapData1[9],
                                    'answer' => $emapData1[10],
                                    'level' => $emapData1[11],
                                    'note' => $emapData1[12]
                                );
                                $this->db->insert('tbl_question', $frm_data);
                            }
                        }
                    }
                }
                fclose($file);
                return "1";
            } else {
                return "2";
            }
        } else {
            return "0";
        }
    }

    public function delete_question_report($id) {
        $this->db->where('id', $id)->delete('tbl_question_reports');
    }

    public function add_daily_quiz($language_id, $question_ids, $daily_quiz_date) {

        $data = $this->db->where('date_published', $daily_quiz_date)->where('language_id', $language_id)->get('tbl_daily_quiz')->result();

        if ($data) {
            $frm_data = array(
                'language_id' => $language_id,
                'questions_id' => $question_ids,
            );
            $this->db->where('id', $data[0]->id)->update('tbl_daily_quiz', $frm_data);
        } else {
            $frm_data = array(
                'language_id' => $language_id,
                'questions_id' => $question_ids,
                'date_published' => $daily_quiz_date
            );
            $this->db->insert('tbl_daily_quiz', $frm_data);
        }
    }

    public function add_data() {
        if (!is_dir(QUESTION_IMG_PATH)) {
            mkdir(QUESTION_IMG_PATH, 0777, TRUE);
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
        $level = $this->input->post('level');
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
                'level' => $level,
                'note' => $note
            );
            $this->db->insert('tbl_question', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = QUESTION_IMG_PATH;
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
                    'level' => $level,
                    'note' => $note
                );
                $this->db->insert('tbl_question', $frm_data);
                return TRUE;
            }
        }
    }

    public function update_data() {
        if (!is_dir(QUESTION_IMG_PATH)) {
            mkdir(QUESTION_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');

        if (is_language_mode_enabled()) {
            $language = ($this->input->post('language_id')) ? $this->input->post('language_id') : 0;
            $data = array('language_id' => $language);
            $this->db->where('id', $id)->update('tbl_question', $data);
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
        $level = $this->input->post('level');
        $answer = $this->input->post('answer');
        $note = $this->input->post('note');

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
            'level' => $level,
            'note' => $note
        );
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $config['upload_path'] = QUESTION_IMG_PATH;
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
                $frm_data['image'] = $data['file_name'];
            }
        }
        $this->db->where('id', $id)->update('tbl_question', $frm_data);
        return TRUE;
    }

    public function delete_data($id, $image_url) {
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_question');
        //remove report question
        $this->db->where('question_id', $id)->delete('tbl_question_reports');
        //remove bookmark question
        $this->db->where('question_id', $id)->delete('tbl_bookmark');
    }

}

?>