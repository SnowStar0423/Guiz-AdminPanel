<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        date_default_timezone_set(get_system_timezone());

        $this->result['full_logo'] = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
        $this->result['half_logo'] = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
        $this->result['app_name'] = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
    }

    public function contest_questions_import() {
        if ($this->input->post('btnadd')) {
            if (!has_permissions('update', 'import_contest_question')) {
                $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
            } else {
                $data = $this->Contest_model->import_data();
                if ($data == "1") {
                    $this->session->set_flashdata('success', 'CSV file is successfully imported!');
                } else if ($data == "0") {
                    $this->session->set_flashdata('error', 'Please upload data in CSV file!');
                } else if ($data == "2") {
                    $this->session->set_flashdata('error', 'Please fill all the data in CSV file!');
                } else {
                    $this->session->set_flashdata('error', $data);
                }
            }
            redirect('contest-questions-import', 'refresh');
        }
        $this->load->view('contest_questions_import', $this->result);
    }

    public function contest_questions() {
        if (!has_permissions('read', 'manage_contest_question')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'manage_contest_question')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data = $this->Contest_model->add_contest_question();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Question created successfully.! ');
                    }
                }
                redirect('contest-questions', 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'manage_contest_question')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Contest_model->update_contest_question();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Question updated successfully.!');
                    }
                }
                redirect('contest-questions', 'refresh');
            }
            $this->result['contest'] = $this->Contest_model->get_data();
            $this->load->view('contest_questions', $this->result);
        }
    }

    public function delete_contest_questions() {
        if (!has_permissions('delete', 'manage_contest_question')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Contest_model->delete_contest_questions($id, $image_url);
            echo TRUE;
        }
    }

    public function contest_prize_distribute($id) {
        if (!has_permissions('read', 'manage_contest')) {
            redirect('/', 'refresh');
        } else {
            $currentDate = date('Y-m-d H:i:s');
            $res = $this->db->where('end_date <=', $currentDate)->where('id', $id)->limit(1)->get('tbl_contest')->result();
            if (!empty($res)) {
                foreach ($res as $contest) {
                    $prize_status = $contest->prize_status;
                    $contest_name = $contest->name;
                    if ($prize_status == 0) {
                        $contest_id = $contest->id;
                        // $type = "Contest Winner - $contest_name ";
                        $type = "wonContest";
                        $res1 = $this->db->where('contest_id', $contest_id)->order_by('top_winner', 'ASC')->get('tbl_contest_prize')->result();
                        if (!empty($res1)) {
                            for ($j = 0; $j < count($res1); $j++) {

                                $u_rank = $res1[$j]->top_winner;
                                $winner_points = $res1[$j]->points;

                                $query2 = $this->db->query("SELECT r.*, u.firebase_id, u.coins FROM (SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM ( SELECT user_id, score FROM tbl_contest_leaderboard c join tbl_users u on u.id = c.user_id WHERE contest_id='" . $contest_id . "' ) s, (SELECT @user_rank := 0) init ORDER BY score DESC ) r INNER join tbl_users u on u.id = r.user_id WHERE r.user_rank='" . $u_rank . "' ORDER BY r.user_rank ASC");
                                $res2 = $query2->result();

                                for ($i = 0; $i < count($res2); $i++) {
                                    $frm_data = array(
                                        'user_id' => $res2[$i]->user_id,
                                        'uid' => $res2[$i]->firebase_id,
                                        'points' => $winner_points,
                                        'type' => $type,
                                        'status' => 0,
                                        'date' => date("Y-m-d")
                                    );
                                    $this->db->insert('tbl_tracker', $frm_data);

                                    $coins = ($res2[$i]->coins + $winner_points);
                                    $frm_data1 = array('coins' => $coins);
                                    $this->db->where('id', $res2[$i]->user_id)->update('tbl_users', $frm_data1);
                                }
                            }
                            $frm_data2 = array('prize_status' => '1');
                            $this->db->where('id', $contest_id)->update('tbl_contest', $frm_data2);

                            $this->session->set_flashdata('success', 'Successfully prizes distributed for - ' . $contest_name . '..!');
                        } else {
                            $this->session->set_flashdata('error', 'Prizes can not distributed for - ' . $contest_name . '..!');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Prizes are already distributed for - ' . $contest_name . '..!');
                    }
                }
            } else {
                $this->session->set_flashdata('error', 'Prize distribution is currently not available. check contest end date..!');
            }
            redirect('contest', 'refresh');
        }
    }

    public function contest_leaderboard() {
        if (!has_permissions('read', 'manage_contest')) {
            redirect('/', 'refresh');
        } else {
            $this->load->view('contest_leaderboard', $this->result);
        }
    }

    public function index() {
        if (!has_permissions('read', 'manage_contest')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'manage_contest')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data = $this->Contest_model->add_contest();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Contest created successfully.! ');
                    }
                }
                redirect('contest', 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'manage_contest')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $data1 = $this->Contest_model->update_contest();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', IMAGE_ALLOW_MSG);
                    } else {
                        $this->session->set_flashdata('success', 'Contest updated successfully.!');
                    }
                }
                redirect('contest', 'refresh');
            }
            if ($this->input->post('btnupdatestatus')) {
                if (!has_permissions('update', 'manage_contest')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $contest_id = $this->input->post('update_id');
                    $res = $this->db->where('contest_id', $contest_id)->get('tbl_contest_question')->result();
                    if (empty($res)) {
                        $this->session->set_flashdata('error', 'No enought question for active contest.!');
                    } else {
                        $this->Contest_model->update_contest_status();
                        $this->session->set_flashdata('success', 'Contest updated successfully.!');
                    }
                }
                redirect('contest', 'refresh');
            }
            $this->load->view('contest', $this->result);
        }
    }

    public function delete_contest() {
        if (!has_permissions('delete', 'manage_contest')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Contest_model->delete_contest($id, $image_url);
            echo TRUE;
        }
    }

    public function contest_prize($id) {
        if (!has_permissions('read', 'manage_contest')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'manage_contest')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $this->Contest_model->add_contest_prize();
                    $this->session->set_flashdata('success', 'Prize created successfully.! ');
                }
                redirect('contest-prize/' . $id, 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'manage_contest')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $this->Contest_model->update_contest_prize();
                    $this->session->set_flashdata('success', 'Prize updated successfully.!');
                }
                redirect('contest-prize/' . $id, 'refresh');
            }
            $this->result['max'] = $this->Contest_model->get_max_top_winner($id);
            $this->load->view('contest_prize', $this->result);
        }
    }

    public function delete_contest_prize() {
        if (!has_permissions('delete', 'manage_contest')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $this->Contest_model->delete_contest_prize($id);
            echo TRUE;
        }
    }

}

?>