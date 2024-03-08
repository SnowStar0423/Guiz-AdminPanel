<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contest_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->toDate = date('Y-m-d');
        $this->toDateTime = date('Y-m-d H:i:s');
    }

    public function get_data() {
        return $this->db->order_by('id', 'DESC')->get('tbl_contest')->result();
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
                    $emapData[0] = $emapData[0]; //contest_id
                    $emapData[1] = trim($emapData[1]);  //question_type
                    $emapData[2] = $emapData[2];     //question
                    $emapData[3] = $emapData[3];    // optiona
                    $emapData[4] = $emapData[4];    // optionb
                    $emapData[5] = $emapData[5];    // optionc
                    $emapData[6] = $emapData[6];    // optiond
                    $emapData[7] = (empty($emapData[7])) ? "" : $emapData[7];  // optione
                    $emapData[8] = trim(strtolower($emapData[8]));  //answer
                    $emapData[9] = $emapData[9];       //note
                    $count++;
                    if ($count > 1) {
                        if ($emapData[1] == '1') {
                            if (!empty($emapData[0]) && !empty($emapData[1]) && !empty($emapData[2]) && $emapData[3] != '' && $emapData[4] != '' && $emapData[5] != '' && $emapData[6] != '' && $emapData[8] != '') {
                                $empty_value_found = true;
                            } else {
                                $empty_value_found = false;
                                echo 'Please Check ' . $count . ' row';
                                break;
                            }
                        } else if ($emapData[1] == '2') {
                            if (!empty($emapData[0]) && !empty($emapData[1]) && !empty($emapData[2]) && $emapData[3] != '' && $emapData[4] != '' && $emapData[8] != '') {
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
                        $emapData1[0] = $emapData1[0]; //contest_id
                        $emapData1[1] = trim($emapData1[1]);  //question_type
                        $emapData1[2] = $emapData1[2];     //question
                        $emapData1[3] = $emapData1[3];    // optiona
                        $emapData1[4] = $emapData1[4];    // optionb
                        $emapData1[5] = $emapData1[5];    // optionc
                        $emapData1[6] = $emapData1[6];    // optiond
                        $emapData1[7] = (empty($emapData1[7])) ? "" : $emapData1[7];  // optione
                        $emapData1[8] = trim(strtolower($emapData1[8]));  //answer
                        $emapData1[9] = $emapData1[9];       //note
                        $count1++;
                        if ($count1 > 1) {
                            if (count($emapData1) > 2) {
                                $frm_data = array(
                                    'contest_id' => $emapData1[0],
                                    'image' => '',
                                    'question' => $emapData1[2],
                                    'question_type' => $emapData1[1],
                                    'optiona' => $emapData1[3],
                                    'optionb' => $emapData1[4],
                                    'optionc' => $emapData1[5],
                                    'optiond' => $emapData1[6],
                                    'optione' => $emapData1[7],
                                    'answer' => $emapData1[8],
                                    'note' => $emapData1[9]
                                );
                                $this->db->insert('tbl_contest_question', $frm_data);
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

    public function add_contest_question() {
        if (!is_dir(CONTEST_QUESTION_IMG_PATH)) {
            mkdir(CONTEST_QUESTION_IMG_PATH, 0777, TRUE);
        }
        $question = $this->input->post('question');
        $contest_id = $this->input->post('contest_id');
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
                'contest_id' => $contest_id,
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
            $this->db->insert('tbl_contest_question', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = CONTEST_QUESTION_IMG_PATH;
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
                    'contest_id' => $contest_id,
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
                $this->db->insert('tbl_contest_question', $frm_data);
                return TRUE;
            }
        }
    }

    public function update_contest_question() {
        if (!is_dir(CONTEST_QUESTION_IMG_PATH)) {
            mkdir(CONTEST_QUESTION_IMG_PATH, 0777, TRUE);
        }
        $id = $this->input->post('edit_id');
        $contest_id = $this->input->post('contest_id');
        $question = $this->input->post('question');
        $question_type = $this->input->post('edit_question_type');
        $a = $this->input->post('a');
        $b = $this->input->post('b');
        $c = ($question_type == 1) ? $this->input->post('c') : "";
        $d = ($question_type == 1) ? $this->input->post('d') : "";
        $e = ($this->input->post('e')) ? $this->input->post('e') : "";
        $answer = $this->input->post('answer');
        $note = $this->input->post('note');

        if ($_FILES['update_file']['name'] == '') {
            $frm_data = array(
                'contest_id' => $contest_id,
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
            $this->db->where('id', $id)->update('tbl_contest_question', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = CONTEST_QUESTION_IMG_PATH;
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
                    'contest_id' => $contest_id,
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
                $this->db->where('id', $id)->update('tbl_contest_question', $frm_data);
                return TRUE;
            }
        }
    }

    public function delete_contest_questions($id, $image_url) {
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_contest_question');
    }

    public function get_max_top_winner($id) {
        return $this->db->select('top_winner as total')->where('contest_id', $id)->order_by('top_winner', 'DESC')->limit(1)->get('tbl_contest_prize')->result();
    }

    public function add_contest() {
        if (!is_dir(CONTEST_IMG_PATH)) {
            mkdir(CONTEST_IMG_PATH, 0777, TRUE);
        }

        $config['upload_path'] = CONTEST_IMG_PATH;
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
                'name' => $this->input->post('name'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'description' => $this->input->post('description'),
                'image' => $img,
                'entry' => $this->input->post('entry'),
                'prize_status' => 0,
                'date_created' => $this->toDateTime,
                'status' => 0
            );
            $this->db->insert('tbl_contest', $frm_data);
            $insert_id = $this->db->insert_id();
            $points = implode(',', array_filter($this->input->post('points')));
            $points1 = explode(',', $points);
            $winner = $this->input->post('winner');
            $count = count($points1);
            for ($i = 0; $i < $count; $i++) {
                $frm_points = array(
                    'contest_id' => $insert_id,
                    'top_winner' => $winner[$i],
                    'points' => $points1[$i],
                );
                $this->db->insert('tbl_contest_prize', $frm_points);
            }
            return TRUE;
        }
    }

    public function update_contest() {
        $id = $this->input->post('edit_id');

        $name = $this->input->post('name');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $description = $this->input->post('description');
        $entry = $this->input->post('entry');

        if ($_FILES['update_file']['name'] == '') {
            $frm_data = array(
                'name' => $name,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'description' => $description,
                'entry' => $entry
            );
            $this->db->where('id', $id)->update('tbl_contest', $frm_data);
            return TRUE;
        } else {
            $config['upload_path'] = CONTEST_IMG_PATH;
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
                    'name' => $name,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'description' => $description,
                    'image' => $img,
                    'entry' => $entry
                );
                $this->db->where('id', $id)->update('tbl_contest', $frm_data);
                return TRUE;
            }
        }
    }

    public function delete_contest($id, $image_url) {

        $this->db->where('contest_id', $id)->delete('tbl_contest_prize');

        //delete question of this category
        $que = $this->db->where('contest_id', $id)->get('tbl_contest_question')->result();
        foreach ($que as $value) {
            if (!empty($value->image) && file_exists(CONTEST_QUESTION_IMG_PATH . $value->image)) {
                unlink(CONTEST_QUESTION_IMG_PATH . $value->image);
            }
        }
        $this->db->where('contest_id', $id)->delete('tbl_contest_question');
        $this->db->where('contest_id', $id)->delete('tbl_contest_leaderboard');

        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_contest');
    }

    public function update_contest_status() {
        $id = $this->input->post('update_id');
        $data = array(
            'status' => $this->input->post('status')
        );
        $this->db->where('id', $id)->update('tbl_contest', $data);
    }

    public function add_contest_prize() {
        $data = array(
            'contest_id' => $this->input->post('contest_id'),
            'top_winner' => $this->input->post('winner'),
            'points' => $this->input->post('points'),
        );
        $this->db->insert('tbl_contest_prize', $data);
    }

    public function update_contest_prize() {
        $id = $this->input->post('edit_id');
        $data = array(
            'points' => $this->input->post('points')
        );
        $this->db->where('id', $id)->update('tbl_contest_prize', $data);
    }

    public function delete_contest_prize($id) {
        $this->db->where('id', $id)->delete('tbl_contest_prize');
    }

}

?>