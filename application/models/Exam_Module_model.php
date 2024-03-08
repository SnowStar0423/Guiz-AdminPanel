<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exam_Module_model extends CI_Model {

    public function get_data() {
        return $this->db->order_by('id', 'DESC')->get('tbl_exam_module')->result();
    }

    public function get_exam_title($exam_id) {
        return $this->db->where('id', $exam_id)->order_by('id', 'DESC')->get('tbl_exam_module')->result();
    }

    public function get_exam_questions($exam_id) {
        return $this->db->where('id', $exam_id)->order_by('id', 'DESC')->get('tbl_exam_module_question')->result();
    }

    public function add_data() {
        $data = array(
            'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
            'title' => $this->input->post('title'),
            'date' => $this->input->post('date'),
            'exam_key' => $this->input->post('exam_key'),
            'duration' => $this->input->post('duration'),
            'answer_again' => ($this->input->post('answer_again')) ? $this->input->post('answer_again') : 0,
            'status' => 0
        );
        $this->db->insert('tbl_exam_module', $data);
    }

    public function update_data() {
        $id = $this->input->post('edit_id');
        $data = array(
            'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
            'title' => $this->input->post('title'),
            'date' => $this->input->post('date'),
            'exam_key' => $this->input->post('exam_key'),
            'duration' => $this->input->post('duration'),
            'answer_again' => $this->input->post('edit_answer_again'),
        );
        $this->db->where('id', $id)->update('tbl_exam_module', $data);
    }

    public function delete_data($id) {
        $this->db->where('exam_module_id', $id)->delete('tbl_exam_module_question');
        $this->db->where('id', $id)->delete('tbl_exam_module');
    }

    public function update_exam_module_status() {
        $id = $this->input->post('update_id');
        $data = array(
            'status' => $this->input->post('status')
        );
        $this->db->where('id', $id)->update('tbl_exam_module', $data);
    }

    public function add_exam_module_question() {
        if (!is_dir(EXAM_QUESTION_IMG_PATH)) {
            mkdir(EXAM_QUESTION_IMG_PATH, 0777, TRUE);
        }
        $exam_module_id = $this->input->post('exam_module_id');
        $marks = $this->input->post('marks');
        $question = $this->input->post('question');

        $question_type = $this->input->post('question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');

        if ($_FILES['file']['name'] == '') {
            $frm_data = array(
                'exam_module_id' => $exam_module_id,
                'marks' => $marks,
                'question' => $question,
                'question_type' => $question_type,
                'optiona' => $a,
                'optionb' => $b,
                'optionc' => $c,
                'optiond' => $d,
                'optione' => $e,
                'answer' => $answer,
            );
            $this->db->insert('tbl_exam_module_question', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = EXAM_QUESTION_IMG_PATH;
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
                    'exam_module_id' => $exam_module_id,
                    'marks' => $marks,
                    'image' => $img,
                    'question' => $question,
                    'question_type' => $question_type,
                    'optiona' => $a,
                    'optionb' => $b,
                    'optionc' => $c,
                    'optiond' => $d,
                    'optione' => $e,
                    'answer' => $answer,
                );
                $this->db->insert('tbl_exam_module_question', $frm_data);
                return TRUE;
            }
        }
    }

    public function update_exam_module_question() {
        if (!is_dir(EXAM_QUESTION_IMG_PATH)) {
            mkdir(EXAM_QUESTION_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');
        $marks = $this->input->post('marks');
        $question = $this->input->post('question');
        $question_type = $this->input->post('question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');

        $frm_data = array(
            'marks' => $marks,
            'question' => $question,
            'question_type' => $question_type,
            'optiona' => $a,
            'optionb' => $b,
            'optionc' => $c,
            'optiond' => $d,
            'optione' => $e,
            'answer' => $answer,
        );

        if($_FILES && $_FILES['update_file']['name']){
            $config['upload_path'] = EXAM_QUESTION_IMG_PATH;
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
                $frm_data['image'] = $data['file_name'];
            }
        }
        $this->db->where('id', $id)->update('tbl_exam_module_question', $frm_data);
        return TRUE;
    }

    public function delete_exam_module_questions($id, $image_url) {
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_exam_module_question');
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
                    $emapData[0] = $emapData[0]; //exam_module_id
                    $emapData[1] = $emapData[1]; //mark
                    $emapData[2] = trim($emapData[2]);   //question_type
                    $emapData[3] = $emapData[3];     //question
                    $emapData[4] = $emapData[4];    // optiona
                    $emapData[5] = $emapData[5];    // optionb
                    $emapData[6] = $emapData[6];    // optionc
                    $emapData[7] = $emapData[7];    // optiond
                    $emapData[8] = (empty($emapData[8])) ? "" : $emapData[8];  // optione
                    $emapData[9] = trim(strtolower($emapData[9]));  //answer
                    $count++;
                    if ($count > 1) {
                        if ($emapData[2] == '1') {
                            if (!empty($emapData[0]) && !empty($emapData[1]) && !empty($emapData[2]) && !empty($emapData[3]) && $emapData[4] != '' && $emapData[5] != '' && $emapData[6] != '' && $emapData[7] != '' && !empty($emapData[9])) {
                                $empty_value_found = true;
                            } else {
                                $empty_value_found = false;
                                echo 'Please Check ' . $count . ' row';
                                break;
                            }
                        } else if ($emapData[2] == '2') {
                            if (!empty($emapData[0]) && !empty($emapData[1]) && !empty($emapData[2]) && !empty($emapData[3]) && $emapData[4] != '' && $emapData[5] != '' && !empty($emapData[9])) {
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
                        $emapData1[0] = trim($emapData1[0]); //exam_module_id
                        $emapData1[1] = $emapData1[1]; //mark
                        $emapData1[2] = trim($emapData1[2]);   //question_type
                        $emapData1[3] = $emapData1[3];     //question
                        $emapData1[4] = $emapData1[4];    // optiona
                        $emapData1[5] = $emapData1[5];    // optionb
                        $emapData1[6] = $emapData1[6];    // optionc
                        $emapData1[7] = $emapData1[7];    // optiond
                        $emapData1[8] = (empty($emapData1[8])) ? "" : $emapData1[8];  // optione
                        $emapData1[9] = trim(strtolower($emapData1[9]));  //answer
                        $count1++;
                        if ($count1 > 1) {
                            if (count($emapData1) > 2) {
                                $frm_data = array(
                                    'exam_module_id' => $emapData1[0],
                                    'marks' => $emapData1[1],
                                    'question' => $emapData1[3],
                                    'question_type' => $emapData1[2],
                                    'optiona' => $emapData1[4],
                                    'optionb' => $emapData1[5],
                                    'optionc' => $emapData1[6],
                                    'optiond' => $emapData1[7],
                                    'optione' => $emapData1[8],
                                    'answer' => $emapData1[9],
                                );
                                $this->db->insert('tbl_exam_module_question', $frm_data);
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

}

?>