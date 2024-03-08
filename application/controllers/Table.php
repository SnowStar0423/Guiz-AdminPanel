<?php

defined('BASEPATH') || exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require APPPATH . '/libraries/REST_Controller.php';

class Table extends REST_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->database();
        date_default_timezone_set(get_system_timezone());
        $this->toDate = date('Y-m-d');
        $this->toDateTime = date('Y-m-d H:i:s');

        $this->load->config('quiz');

        $this->category_type = $this->config->item('category_type');

        $this->result['full_logo'] = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
        $this->result['half_logo'] = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();

        $this->NO_IMAGE = base_url() . LOGO_IMG_PATH . $this->result['half_logo']['message'];
    }

    public function slider_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $where = " WHERE s.language_id=" . $language_id . "";
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            if ($this->get('language') && $this->get('language') != '') {
                $where .= " AND (s.`id` like '%" . $search . "%' OR s.`title` like '%" . $search . "%' OR s.`description` like '%" . $search . "%' OR l.`language` like '%" . $search . "%' )";
            } else {
                $where = " WHERE (s.`id` like '%" . $search . "%' OR s.`title` like '%" . $search . "%' OR s.`description` like '%" . $search . "%' OR l.`language` like '%" . $search . "%' )";
            }            
        }

        $join = " LEFT JOIN tbl_languages l on l.id = s.language_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_slider s $join $where");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }
        

        $query1 = $this->db->query("SELECT s.*,l.language FROM tbl_slider s $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? SLIDER_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['description'] = $row->description;
            $tempRow['title'] = $row->title;
            $tempRow['image'] = (!empty($image)) ? '<a href=' . base_url() . $image . '  data-lightbox="Slider Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : '<img src=' . $this->NO_IMAGE . ' height=30 >';
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function maths_question_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('language') && $this->get('language') != '') {
            $where = " WHERE q.language_id=" . $this->get('language') . "";
            if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        } else if ($this->get('category') && $this->get('category') != '') {
            $where = ' WHERE q.category=' . $this->get('category');
            if ($this->get('subcategory') && $this->get('subcategory') != '') {
                $where .= ' AND q.subcategory=' . $this->get('subcategory');
            }
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (q.`id` like '%" . $search . "%' OR `question` like '%" . $search . "%' OR `optiona` like '%" . $search . "%' OR `optionb` like '%" . $search . "%' OR `optionc` like '%" . $search . "%' OR `optiond` like '%" . $search . "%' OR `answer` like '%" . $search . "%')";
            if ($this->get('language') && $this->get('language') != '') {
                $where .= " AND q.language_id=" . $this->get('language') . "";
                if ($this->get('category') && $this->get('category') != '') {
                    $where .= ' AND q.category=' . $this->get('category');
                    if ($this->get('subcategory') && $this->get('subcategory') != '') {
                        $where .= ' AND q.subcategory=' . $this->get('subcategory');
                    }
                }
            } else if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        }

        $join = " LEFT JOIN tbl_languages l ON l.id = q.language_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_maths_question q $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT q.*, l.language FROM tbl_maths_question q $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? MATHS_QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="'.base_url() ."create-maths-questions/".$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="Question Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : 'No Image';
            $tempRow['question_type'] = $row->question_type;
            $tempRow['answer'] = $row->answer;
            $tempRow['question'] = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
            $tempRow['optiona'] = "<textarea class='editor-questions-inline'>" . $row->optiona . "</textarea>";
            $tempRow['optionb'] = "<textarea class='editor-questions-inline'>" . $row->optionb . "</textarea>";
            $tempRow['optionc'] = "<textarea class='editor-questions-inline'>" . $row->optionc . "</textarea>";
            $tempRow['optiond'] = "<textarea class='editor-questions-inline'>" . $row->optiond . "</textarea>";
            $tempRow['optione'] = "<textarea class='editor-questions-inline'>" . $row->optione . "</textarea>";
            $tempRow['note'] = "<textarea class='editor-questions-inline'>" . $row->note . "</textarea>";

            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function payment_requests_list_get(){
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('user_id') && $this->get('user_id') != '') {
            $user_id = $this->get('user_id');
            $where = " WHERE t.user_id=" . $user_id . "";
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (t.id like '%" . $search . "%' OR u.name like '%" . $search . "%' OR t.payment_type like '%" . $search . "%' )";
            if ($this->get('user_id') && $this->get('user_id') != '') {
                $user_id = $this->get('user_id');
                $where .= " AND t.user_id=" . $user_id . "";
            }
        }

        $join = " LEFT JOIN tbl_users u on u.id = t.user_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_payment_request t $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT t.*, u.name FROM tbl_payment_request t $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) { 
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            
            $paymentAddress = '';
            $payment_address = json_decode($row->payment_address);
            // echo count($payment_address);
            for ($i=0; $i <count($payment_address) ; $i++) { 
                $paymentAddress .= $payment_address[$i].'<br/>';
            }

            $tempRow['id'] = $row->id;
            $tempRow['uid'] = $row->uid;
            $tempRow['user_id'] = $row->user_id;
            $tempRow['name'] = $row->name;
            $tempRow['payment_type'] = $row->payment_type;
            $tempRow['payment_address'] = $paymentAddress;
            $tempRow['payment_amount'] = $row->payment_amount;
            $tempRow['coin_used'] = $row->coin_used;
            $tempRow['details'] = $row->details;
            $tempRow['status1'] = $row->status;
            $tempRow['status'] = ($row->status) ? (($row->status == 1) ? "<label class='badge badge-success'>Completed</label>" : "<label class='badge badge-danger'>Invalid Details</label>") : "<label class='badge badge-warning'>Pending</label>";
            $tempRow['date'] = $row->date;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function tracker_list_get(){
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('user_id') && $this->get('user_id') != '') {
            $user_id = $this->get('user_id');
            $where = " WHERE t.user_id=" . $user_id . "";
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (t.id like '%" . $search . "%' OR u.name like '%" . $search . "%' OR t.points like '%" . $search . "%' OR t.date like '%" . $search . "%')";
            if ($this->get('user_id') && $this->get('user_id') != '') {
                $user_id = $this->get('user_id');
                $where .= " AND t.user_id=" . $user_id . "";
            }
        }

        $join = " LEFT JOIN tbl_users u on u.id = t.user_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_tracker t $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT t.*, u.name FROM tbl_tracker t $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;

        $type_key = array(
            "wonQuizZone" => "Won Quiz Zone Quiz",
            "wonBattle" => "Won Battle",
            "usedSkiplifeline" => "Used Skip lifeline",
            "usedAudiencePolllifeline" => "Used Audience-poll lifeline",
            "usedResetTimerlifeline" => "Used Reset-timer lifeline",
            "used5050lifeline" => "Used 50-50 lifeline",
            "usedHintLifeline" => "Used Hint lifeline",
            "rewardByScratchingCard" => "Reward By Scratching Card",
            "boughtCoins" => "Bought Coins",
            "watchedRewardAd" => "Watched Reward Ad",
            "wonAudioQuiz" => "Won Audio Quiz",
            "wonDailyQuiz" => "Won Daily Quiz",
            "wonTrueFalse" => "Won True / False Quiz",
            "wonFunNLearn" => "Won Fun N Learn Quiz",
            "wonGuessTheWord" => "Won Guess The Word Quiz",
            "wonGroupBattle" => "Won Group Battle",
            "playedGroupBattle" => "Played Group Battle",
            "playedContest" => "Played Contest",
            "playedBattle" => "Played Battle",
            "redeemedAmount" => "Redeemed Amount",
            "welcomeBonus" => "Welcome Bonus",
            "wonContest" => "Won Contest",
            "redeemRequest" => "Redeem Request",  
            "reversedByAdmin" => "Reversed by admin", 
            "referredCodeToFriend" => "Referred Code To Friend",
            "usedReferCode" => "Used Refer Code",
            "reviewAnswers" => "Review answers",
            "wonMathQuiz" => "Won Math Quiz"
        );

        foreach ($res1 as $row) { 
            $tempRow['id'] = $row->id;
            $tempRow['uid'] = $row->uid;
            $tempRow['name'] = $row->name;
            $tempRow['points'] = $row->points;
            $tempRow['type'] = (isset($type_key[$row->type])) ? $type_key[$row->type] : $row->type;
            $tempRow['date'] = $row->date;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function exam_module_result_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('exam_module_id') && $this->get('exam_module_id') != '') {
            $where = ' WHERE exam_module_id=' . $this->get('exam_module_id');
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (r.`id` like '%" . $search . "%' OR u.`name` like '%" . $search . "%' )";
        }

        $join = " LEFT JOIN tbl_users u on u.id = r.user_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_exam_module_result r $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT r.*, u.name FROM tbl_exam_module_result r $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-eye"></i></a>';
            // $operate .=($row->rules_violated) ? '<a class="edit-captured" data-toggle="modal" data-target="#editCapturedModal"><label class="badge badge-success">Yes</label></a>' : '<label class="badge badge-danger">No</label>'; 

            $tempRow['id'] = $row->id;
            $tempRow['exam_module_id'] = $row->exam_module_id;
            $tempRow['user_id'] = $row->user_id;
            $tempRow['name'] = $row->name;
            $tempRow['obtained_marks'] = $row->obtained_marks;
            $tempRow['total_duration'] = $row->total_duration;
            $tempRow['statistics'] = $row->statistics;
            $tempRow['rules_violated'] = ($row->rules_violated) ? '<a class="edit-captured" data-toggle="modal" data-target="#editCapturedModal"><label class="badge badge-success">Yes</label></a>' : '<label class="badge badge-danger">No</label>';
            $tempRow['captured_question_ids'] = $row->captured_question_ids;
            $captured_res = '';
            if ($row->rules_violated == 1) {
                $captured = json_decode($row->captured_question_ids);
                if(!(empty($captured))){
                    $captured_res = $this->db->query("SELECT id, question FROM tbl_exam_module_question WHERE id IN (" . implode(',', $captured) . ")")->result();
                }
            }
            $tempRow['captured_que'] = (!empty($captured_res)) ? json_encode($captured_res) : '';
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function exam_module_questions_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('exam_module_id') && $this->get('exam_module_id') != '') {
            $where = ' WHERE tq.exam_module_id=' . $this->get('exam_module_id');
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (tq.`id` like '%" . $search . "%' OR tq.`question` like '%" . $search . "%' OR tq.`optiona` like '%" . $search . "%' OR tq.`optionb` like '%" . $search . "%' OR tq.`optionc` like '%" . $search . "%' OR tq.`optiond` like '%" . $search . "%' OR tq.`answer` like '%" . $search . "%')";
            if ($this->get('exam_module_id') && $this->get('exam_module_id') != '') {
                $where .= ' AND tq.exam_module_id=' . $this->get('exam_module_id');
            }
        }

        $join = " JOIN tbl_exam_module te ON te.id = tq.exam_module_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_exam_module_question tq $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT tq.* FROM tbl_exam_module_question tq $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? EXAM_QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="'.base_url() ."exam-module-questions-edit/".$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['exam_module_id'] = $row->exam_module_id;
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="Question Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : 'No Image';
            $tempRow['marks'] = $row->marks;
            $tempRow['question_type'] = $row->question_type;
            $tempRow['question'] = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
            $tempRow['optiona'] = "<textarea class='editor-questions-inline'>" . $row->optiona . "</textarea>";
            $tempRow['optionb'] = "<textarea class='editor-questions-inline'>" . $row->optionb . "</textarea>";
            $tempRow['optionc'] = "<textarea class='editor-questions-inline'>" . $row->optionc . "</textarea>";
            $tempRow['optiond'] = "<textarea class='editor-questions-inline'>" . $row->optiond . "</textarea>";
            $tempRow['optione'] = "<textarea class='editor-questions-inline'>" . $row->optione . "</textarea>";
            $tempRow['answer'] = $row->answer;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function exam_module_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $where = " WHERE c.language_id=" . $language_id . "";
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (c.`id` like '%" . $search . "%' OR c.`title` like '%" . $search . "%' OR l.`language` like '%" . $search . "%' )";
            if ($this->get('language') && $this->get('language') != '') {
                $language_id = $this->get('language');
                $where .= " AND c.language_id=" . $language_id . "";
            }
        }

        $join = " LEFT JOIN tbl_languages l on l.id = c.language_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_exam_module c $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT c.*,l.language, (select count(id) from tbl_exam_module_question q where q.exam_module_id = c.id ) as no_of_que FROM tbl_exam_module c $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $operate = "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "exam-module-questions/" . $row->id . "' title='Add question'><i class='fas fa-plus'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-info' href='" . base_url() . "exam-module-questions-list/" . $row->id . "' title='List Questions'><i class='fas fa-list'></i></a>";
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= "<a class='btn btn-icon btn-sm btn-success edit-status' data-id='" . $row->id . "' data-toggle='modal' data-target='#editStatusModal' title='Edit Status'><i class='fas fa-edit'></i></a>";
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . '><i class="fa fa-trash"></i></a>';
            if ($this->toDate >= $row->date) {
                $operate .= "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "exam-module-result/" . $row->id . "' title='Result'><i class='fas fa-list-alt'></i></a>";
            }

            $tempRow['id'] = $row->id;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['title'] = $row->title;
            $tempRow['date'] = $row->date;
            $tempRow['exam_key'] = $row->exam_key;
            $tempRow['duration'] = $row->duration;
            $tempRow['no_of_que'] = $row->no_of_que;
            $tempRow['status'] = ($row->status) ? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-danger'>Deactive</label>";
            $tempRow['answer_again'] = ($row->answer_again) ? "<label class='badge badge-success'>Yes</label>" : "<label class='badge badge-danger'>No</label>";
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function guess_the_word_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('language') && $this->get('language') != '') {
            $where = " WHERE q.language_id=" . $this->get('language') . "";
            if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        } else if ($this->get('category') && $this->get('category') != '') {
            $where = ' WHERE q.category=' . $this->get('category');
            if ($this->get('subcategory') && $this->get('subcategory') != '') {
                $where .= ' AND q.subcategory=' . $this->get('subcategory');
            }
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (q.`id` like '%" . $search . "%' OR `question` like '%" . $search . "%' OR `answer` like '%" . $search . "%')";
            if ($this->get('language') && $this->get('language') != '') {
                $where .= " AND q.language_id=" . $this->get('language') . "";
                if ($this->get('category') && $this->get('category') != '') {
                    $where .= ' AND q.category=' . $this->get('category');
                    if ($this->get('subcategory') && $this->get('subcategory') != '') {
                        $where .= ' AND q.subcategory=' . $this->get('subcategory');
                    }
                }
            } else if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        }

        $join = " LEFT JOIN tbl_languages l ON l.id = q.language_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_guess_the_word q $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT q.*, l.language FROM tbl_guess_the_word q $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? GUESS_WORD_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="Question Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : 'No Image';
            $tempRow['question'] = $row->question;
            $tempRow['answer'] = $row->answer;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function fun_n_learn_question_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('fun_n_learn_id') && $this->get('fun_n_learn_id') != '') {
            $where = ' WHERE tq.fun_n_learn_id=' . $this->get('fun_n_learn_id');
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (q.`id` like '%" . $search . "%' OR `question` like '%" . $search . "%' OR `optiona` like '%" . $search . "%' OR `optionb` like '%" . $search . "%' OR `optionc` like '%" . $search . "%' OR `optiond` like '%" . $search . "%' OR `answer` like '%" . $search . "%')";
            if ($this->get('fun_n_learn_id') && $this->get('fun_n_learn_id') != '') {
                $where .= ' AND tq.fun_n_learn_id=' . $this->get('fun_n_learn_id');
            }
        }

        $join = " JOIN tbl_fun_n_learn tc ON tc.id = tq.fun_n_learn_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_fun_n_learn_question tq $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT tq.* FROM tbl_fun_n_learn_question tq $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . '><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['fun_n_learn_id'] = $row->fun_n_learn_id;
            $tempRow['question'] = $row->question;
            $tempRow['question_type'] = $row->question_type;
            $tempRow['optiona'] = $row->optiona;
            $tempRow['optionb'] = $row->optionb;
            $tempRow['optionc'] = $row->optionc;
            $tempRow['optiond'] = $row->optiond;
            $tempRow['optione'] = $row->optione;
            $tempRow['answer'] = $row->answer;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function fun_n_learn_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $where = " WHERE c.language_id=" . $language_id . "";
            if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND c.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND c.subcategory=' . $this->get('subcategory');
                }
            }
        } else if ($this->get('category') && $this->get('category') != '') {
            $where = ' WHERE c.category=' . $this->get('category');
            if ($this->get('subcategory') && $this->get('subcategory') != '') {
                $where .= ' AND c.subcategory=' . $this->get('subcategory');
            }
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (c.`id` like '%" . $search . "%' OR c.`title` like '%" . $search . "%' OR l.`language` like '%" . $search . "%' )";
            if ($this->get('language') && $this->get('language') != '') {
                $language_id = $this->get('language');
                $where .= " AND c.language_id=" . $language_id . "";
                if ($this->get('category') && $this->get('category') != '') {
                    $where .= ' AND c.category=' . $this->get('category');
                    if ($this->get('subcategory') && $this->get('subcategory') != '') {
                        $where .= ' AND c.subcategory=' . $this->get('subcategory');
                    }
                }
            } else if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND c.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND c.subcategory=' . $this->get('subcategory');
                }
            }
        }

        $join = " LEFT JOIN tbl_languages l on l.id = c.language_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_fun_n_learn c $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT c.*,l.language, (select count(id) from tbl_fun_n_learn_question q where q.fun_n_learn_id = c.id ) as no_of_que FROM tbl_fun_n_learn c $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $operate = "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "fun-n-learn-questions/" . $row->id . "' title='Add question'><i class='fas fa-plus'></i></a>";
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= "<a class='btn btn-icon btn-sm btn-success edit-status' data-id='" . $row->id . "' data-toggle='modal' data-target='#editStatusModal' title='Edit Status'><i class='fas fa-edit'></i></a>";
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . '><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['language'] = $row->language;
            $tempRow['title'] = $row->title;
            $tempRow['detail'] = $row->detail;
            $tempRow['no_of_que'] = $row->no_of_que;
            $tempRow['status'] = ($row->status) ? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-danger'>Deactive</label>";
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function battle_statistics_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = $where_sub = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('user_id')) {
            $user_id = $this->get('user_id');
            $where = " WHERE user_id1 = $user_id or user_id2 = $user_id";
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (r.id like '%" . $search . "%' OR u.name like '%" . $search . "%'  OR u.email like '%" . $search . "%')";
        }

        $query = $this->db->query("SELECT COUNT(id) as total FROM tbl_battle_statistics $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT *, (SELECT name FROM tbl_users u WHERE u.id = m.user_id1) AS user_1, (SELECT name FROM tbl_users u WHERE u.id = m.user_id2) AS user_2 FROM tbl_battle_statistics m $where GROUP BY date_created ORDER BY $sort $order LIMIT $offset, $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;

        foreach ($res1 as $row) {
            $tempRow['id'] = $row->id;
            $tempRow['opponent_id'] = ($row->user_id1 == $user_id) ? $row->user_id2 : $row->user_id1;
            $tempRow['opponent_name'] = ($row->user_id1 == $user_id) ? $row->user_2 : $row->user_1;

            if ($row->is_drawn == 1) {
                $tempRow['mystatus'] = "Draw";
            } else {
                $tempRow['mystatus'] = ($row->winner_id == $user_id) ? "Won" : "Lost";
            }
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function daily_leaderboard_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'r.user_rank';
        $order = 'ASC';
        $where = $where_sub = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        $where_sub = " WHERE ( DATE(date_created) = DATE('" . $this->toDate . "') ) ";

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (r.id like '%" . $search . "%' OR u.name like '%" . $search . "%'  OR u.email like '%" . $search . "%')";
        }

        $query = $this->db->query("SELECT COUNT(r.id) AS total FROM (SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM (SELECT id,user_id, score, date_created  FROM tbl_leaderboard_daily d $where_sub) s, (SELECT @user_rank := 0) init ORDER BY score DESC) r INNER join tbl_users u on u.id = r.user_id $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT r.*,u.email,u.name,u.profile FROM (SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM (SELECT id,user_id, score, date_created  FROM tbl_leaderboard_daily d $where_sub) s, (SELECT @user_rank := 0) init ORDER BY score DESC, date_created ASC) r INNER join tbl_users u on u.id = r.user_id $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;

        foreach ($res1 as $row) {
            $tempRow['id'] = $count;
            $tempRow['user_id'] = $row->user_id;
            $tempRow['name'] = $row->name;
            $tempRow['email'] = $row->email;
            $tempRow['score'] = $row->score;
            $tempRow['user_rank'] = $row->user_rank;
            $tempRow['date_created'] = date('d-M-Y h:i A', strtotime($row->date_created));
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function monthly_leaderboard_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'r.user_rank';
        $order = 'ASC';
        $where = $where1 = $where_sub = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('year') && $this->get('year') != '') {
            $year = $this->get('year');
            $where1 = " WHERE (YEAR(m.date_created) = '" . $year . "') ";
            $where_sub = " WHERE (YEAR(m.date_created) = '" . $year . "') ";
            if ($this->get('month') && $this->get('month') != '') {
                $month = $this->get('month');
                $where1 .= " AND (MONTH(m.date_created) = '" . $month . "') ";
                $where_sub .= " AND (MONTH(m.date_created) = '" . $month . "') ";
            }
        } else if ($this->get('month') && $this->get('month') != '') {
            $month = $this->get('month');
            $where1 = " WHERE ( MONTH(m.date_created) = '" . $month . "') ";
            $where_sub = " WHERE ( MONTH(m.date_created) = '" . $month . "') ";
        }

        if ($this->get('user_id')) {
            $user_id = $this->get('user_id');
            if ($this->get('user_id') != '')
                $where1 .= " AND user_id=" . $user_id;
            $where .= " AND user_id=" . $user_id;
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where1 .= " AND (u.name like '%" . $search . "%' OR u.email like '%" . $search . "%' )";
            $where .= " AND (u.name like '%" . $search . "%' OR u.email like '%" . $search . "%' )";
        }


        $query = $this->db->query("SELECT COUNT(*) AS total FROM tbl_leaderboard_monthly m INNER JOIN tbl_users u ON m.user_id=u.id $where_sub $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT u.email,u.name,u.profile,r.* FROM (SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM ( SELECT m.id, user_id, sum(score) score,last_updated,date_created, MAX(last_updated) as latest_updated FROM tbl_leaderboard_monthly m join tbl_users u on u.id = m.user_id $where_sub GROUP BY user_id) s, (SELECT @user_rank := 0) init ORDER BY score DESC, latest_updated ASC ) r INNER join tbl_users u on u.id = r.user_id $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;

        foreach ($res1 as $row) {
            $tempRow['id'] = $row->id;
            $tempRow['name'] = $row->name;
            $tempRow['email'] = $row->email;
            $tempRow['user_id'] = $row->user_id;
            $tempRow['score'] = $row->score;
            $tempRow['user_rank'] = $row->user_rank;
            $tempRow['last_updated'] = date("d-m-Y H:m:s", strtotime($row->last_updated));
            $tempRow['date_created'] = date("d-m-Y H:m:s", strtotime($row->date_created));
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function global_leaderboard_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'r.user_rank';
        $order = 'ASC';
        $where = $where_sub = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (r.id like '%" . $search . "%' OR u.name like '%" . $search . "%' OR u.email like '%" . $search . "%' )";
        }

        $query = $this->db->query("SELECT count(r.user_id) as total FROM ( SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM ( SELECT m.id, user_id, sum(score) score, MAX(last_updated) as latest_updated FROM tbl_leaderboard_monthly m join tbl_users u on u.id = m.user_id GROUP BY user_id) s, (SELECT @user_rank := 0) init ORDER BY score DESC, latest_updated ASC) r INNER join tbl_users u on u.id = r.user_id $where");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT r.*, u.email,u.name FROM ( SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM ( SELECT m.id, user_id, sum(score) score, MAX(last_updated) as latest_updated FROM tbl_leaderboard_monthly m join tbl_users u on u.id = m.user_id GROUP BY user_id) s, (SELECT @user_rank := 0) init ORDER BY score DESC, latest_updated ASC) r INNER join tbl_users u on u.id = r.user_id $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;

        foreach ($res1 as $row) {
            $tempRow['id'] = $count;
            $tempRow['user_id'] = $row->user_id;
            $tempRow['name'] = $row->name;
            $tempRow['email'] = $row->email;
            $tempRow['score'] = $row->score;
            $tempRow['user_rank'] = $row->user_rank;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function contest_leaderboard_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = $where_sub = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        $contest_id = $this->get('contest_id');
        $where = " WHERE contest_id=" . $contest_id . "";
        $where_sub = " WHERE contest_id = '" . $contest_id . "'";

        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (`user_id` like '%" . $search . "%' OR `score` like '%" . $search . "%')";
        }


        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_contest_leaderboard  as r $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT r.*,u.name,u.profile FROM (SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM ( SELECT c.* FROM tbl_contest_leaderboard c join tbl_users u on u.id = c.user_id  $where_sub ) s, (SELECT @user_rank := 0) init ORDER BY score DESC, last_updated ASC) r INNER join tbl_users u on u.id = r.user_id $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $tempRow['id'] = $row->id;
            $tempRow['name'] = $row->name;
            $tempRow['user_id'] = $row->user_id;
            $tempRow['contest_id'] = $row->contest_id;
            $tempRow['questions_attended'] = $row->questions_attended;
            $tempRow['correct_answers'] = $row->correct_answers;
            $tempRow['score'] = $row->score;
            $tempRow['user_rank'] = $row->user_rank;
            $tempRow['last_updated'] = $row->last_updated;
            $tempRow['date_created'] = $row->date_created;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function contest_question_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('contest_id') && $this->get('contest_id') != '') {
            $where = ' WHERE tq.contest_id=' . $this->get('contest_id');
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (q.`id` like '%" . $search . "%' OR `question` like '%" . $search . "%' OR `optiona` like '%" . $search . "%' OR `optionb` like '%" . $search . "%' OR `optionc` like '%" . $search . "%' OR `optiond` like '%" . $search . "%' OR `answer` like '%" . $search . "%')";
            if ($this->get('contest_id') && $this->get('contest_id') != '') {
                $where .= ' AND tq.contest_id=' . $this->get('contest_id');
            }
        }

        $join = " JOIN tbl_contest tc ON tc.id = tq.contest_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_contest_question tq $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT tq.*, tc.name FROM tbl_contest_question tq $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? CONTEST_QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['contest_id'] = $row->contest_id;
            $tempRow['name'] = $row->name;
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="Question Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : 'No Image';
            $tempRow['question'] = $row->question;
            $tempRow['question_type'] = $row->question_type;
            $tempRow['optiona'] = $row->optiona;
            $tempRow['optionb'] = $row->optionb;
            $tempRow['optionc'] = $row->optionc;
            $tempRow['optiond'] = $row->optiond;
            $tempRow['optione'] = $row->optione;
            $tempRow['answer'] = $row->answer;
            $tempRow['note'] = $row->note;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function contest_prize_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        $contest_id = $this->get('contest_id');
        $where = " WHERE p.contest_id=" . $contest_id . "";

        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (`id` like '%" . $search . "%' OR `points` like '%" . $search . "%' )";
        }

        $join = " JOIN tbl_contest c ON c.id = p.contest_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_contest_prize p $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT p.*, c.name FROM tbl_contest_prize p $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' ><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['name'] = $row->name;
            $tempRow['top_winner'] = $row->top_winner;
            $tempRow['points'] = $row->points;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function contest_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');


        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (id like '%" . $search . "%' OR name like '%" . $search . "%' OR description like '%" . $search . "%' )";
        }

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_contest c $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT c.*,(select count(contest_id) FROM tbl_contest_prize cp WHERE cp.contest_id=c.id) as top_users,(SELECT COUNT('id') from tbl_contest_leaderboard cl where cl.contest_id = c.id ) as participants,(SELECT COUNT('id') from tbl_contest_question q where q.contest_id=c.id) as total_question FROM tbl_contest c $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? CONTEST_IMG_PATH . $row->image : '';
            $operate = "<a class='btn btn-icon btn-sm btn-primary edit-data' data-id='" . $row->id . "' data-image='" . $image . "' data-toggle='modal' data-target='#editDataModal' title='Edit'><i class='fas fa-edit'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-success edit-status' data-id='" . $row->id . "' data-toggle='modal' data-target='#editStatusModal' title='Edit Status'><i class='fas fa-edit'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-danger delete-data' data-id='" . $row->id . "' data-image='" . $image . "' title='Delete'><i class='fas fa-trash'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "contest-leaderboard/" . $row->id . "' title='View Top Users'><i class='fas fa-list'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-info' href='contest-prize-distribute/" . $row->id . "' title='Ready to Distribute Prize'><i class='fas fa-bullhorn'></i></a>";

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['name'] = $row->name;
            $tempRow['start_date'] = $row->start_date;
            $tempRow['end_date'] = $row->end_date;
            $tempRow['image'] = "<a data-fancybox='Contest Gallery' href='" . $image . "' data-lightbox='" . $row->name . "'><img src='" . $image . "' title='" . $row->name . "' width='50'/></a>";
            $tempRow['description'] = $row->description;
            $tempRow['entry'] = $row->entry;
            $tempRow['top_users'] = '<a class="btn btn-xs btn-warning" href="' . base_url() . 'contest-prize/' . $row->id . '" title="View Prize">' . $row->top_users . '</a>';
            $tempRow['participants'] = $row->participants;
            $tempRow['total_question'] = $row->total_question;
            $tempRow['status'] = ($row->status) ? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-danger'>Deactive</label>";
            $tempRow['prize_status'] = ($row->prize_status == 0) ? '<label class="badge badge-warning">Not Distributed</label>' : '<label class="badge badge-success">Distributed</label>';
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function user_account_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'auth_id';
        $order = 'DESC';
        $where = ' WHERE status=0';
        $table = $this->get('table');

        if ($this->post('id'))
            $id = $this->post('id');

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (`auth_id` like '%" . $search . "%' OR `auth_username` like '%" . $search . "%' OR `role` like '%" . $search . "%')";
        }

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_authenticate $where");
        $res = $query->result();

        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT * FROM tbl_authenticate $where  ORDER BY  $sort  $order  LIMIT  $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        foreach ($res1 as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->auth_id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->auth_id . '><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->auth_id;
            $tempRow['auth_username'] = $row->auth_username;
            $tempRow['role'] = $row->role;
            $tempRow['permissions'] = json_decode($row->permissions, 1);
            $tempRow['created'] = date('d-m-Y H:m a', strtotime($row->created));
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function notification_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';
        $table = $this->get('table');

        if ($this->post('id'))
            $id = $this->post('id');

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = "where (`id` like '%" . $search . "%' OR `title` like '%" . $search . "%')";
        }

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_notifications n $where");
        $res = $query->result();

        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT * FROM tbl_notifications n $where  ORDER BY  $sort  $order  LIMIT  $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? NOTIFICATION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image=' . $image . '><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['title'] = $row->title;
            $tempRow['message'] = $row->message;
            $tempRow['users'] = ucwords($row->users);
            $tempRow['type'] = ucwords($row->type);
            $tempRow['type_id'] = ucwords($row->type_id);
            $tempRow['date_sent'] = date('d-m-Y', strtotime($row->date_sent));
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="Image"><img src=' . base_url() . $image . ' height=50, width=50 >' : 'No Image';
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function users_get() {
        
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('status') != '') {
            $status = $this->get('status');
            $where = " WHERE (`status` = " . $status . ")";
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (id like '%" . $search . "%' OR name like '%" . $search . "%' OR mobile like '%" . $search . "%' OR email like '%" . $search . "%' OR date_registered like '%" . $search . "%' )";
            if ($this->get('status') != '') {
                $status = $this->get('status');
                $where .= " AND (`status` = " . $status . ")";
            }
        }

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_users $where ");
        $res1 = $query->result();
        foreach ($res1 as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT * FROM tbl_users  $where  ORDER BY  $sort  $order  LIMIT  $offset , $limit");
        $res = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;

        $icon = array(
            'email' => 'far fa-envelope-open',
            'gmail' => 'fab fa-google-plus-square text-danger',
            'fb' => 'fab fa-facebook-square text-primary',
            'mobile' => 'fa fa-phone-square',
            'apple' => 'fab fa-apple'
        );

        foreach ($res as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= "<a class='btn btn-icon btn-sm btn-success' href='" . base_url() . "monthly-leaderboard/" . $row->id . "' title='Monthly Leaderboard'><i class='fas fa-th'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-info' href='" . base_url() . "battle-statistics/" . $row->id . "' title='User Statistics'><i class='fas fa-chart-pie'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "activity-tracker/" . $row->id . "' title='Track Activities'><i class='far fa-chart-bar'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-primary' href='" . base_url() . "payment-requests/" . $row->id . "' title='Track Activities'><i class='fas fa-rupee-sign'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-info admin-coin' data-id='" . $row->id . "' data-toggle='modal' data-target='#coinsmodal' title='Coins'><i class='fas fa-coins'></i></a>";
//            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' ><i class="fa fa-trash"></i></a>';

            if (filter_var($row->profile, FILTER_VALIDATE_URL) === FALSE) {
                // Not a valid URL. Its a image only or empty
                $profile = (!empty($row->profile)) ? base_url() . USER_IMG_PATH . $row->profile : '';
            } else {
                /* if it is a ur than just pass url as it is */
                $profile = $row->profile;
            }


            // $profile = base_url().'images/profile/'.$row->profile;


            $tempRow['id'] = $row->id;
            $tempRow['profile'] = (!empty($row->profile)) ? "<a data-lightbox='Profile Picture' href='" . $profile . "'><img src='" . $profile . "' width='80'/></a>" : "No Image";
            $tempRow['name'] = $row->name;
            $tempRow['email'] =   $row->email;
            $tempRow['mobile'] =  $row->mobile;
            $tempRow['type'] = (isset($row->type) && $row->type != '') ? '<em class="' . $icon[trim($row->type)] . ' fa-2x"></em>' : '<em class="' . $icon['email'] . ' fa-2x"></em>';
            $tempRow['fcm_id'] = $row->fcm_id;
            $tempRow['coins'] = $row->coins;
            $tempRow['refer_code'] = $row->refer_code;
            $tempRow['friends_code'] = $row->friends_code;
            $tempRow['remove_ads'] = ($row->remove_ads) ? "<label class='badge badge-success'>YES</label>" : "<label class='badge badge-danger'>NO</label>";
            $tempRow['date_registered'] = date('d-M-Y h:i A', strtotime($row->date_registered));
            $tempRow['status'] = ($row->status) ? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-danger'>Deactive</label>";
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function question_reports_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (qr.id like '%" . $search . "%' OR message like '%" . $search . "%' OR u.name like '%" . $search . "%' )";
        }

        $join = " JOIN tbl_users u ON u.id = qr.user_id";
        $join .= " JOIN tbl_question q ON q.id = qr.question_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_question_reports qr $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT qr.*, u.name, q.category, q.subcategory, q.language_id, q.image, q.question, q.question_type, q.optiona, q.optionb, q.optionc, q.optiond, q.optione, q.answer, q.level, q.note FROM tbl_question_reports qr $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? QUESTION_IMG_PATH . $row->image : '';
            // $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="'.base_url() ."question-reports/".$row->question_id.'" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . '><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['question_id'] = $row->question_id;
            $tempRow['question'] = $row->question;
            $tempRow['user_id'] = $row->user_id;
            $tempRow['name'] = $row->name;
            $tempRow['message'] = $row->message;
            $tempRow['date'] = date('d-M-Y h:i A', strtotime($row->date));

            $tempRow['image_url'] = $image;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['question_type'] = $row->question_type;
            $tempRow['question'] = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
            $tempRow['level'] = $row->level;
            $tempRow['answer'] = $row->answer;
            $tempRow['operate'] = $operate;

            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function question_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('language') && $this->get('language') != '') {
            $where = " WHERE q.language_id=" . $this->get('language') . "";
            if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        } else if ($this->get('category') && $this->get('category') != '') {
            $where = ' WHERE q.category=' . $this->get('category');
            if ($this->get('subcategory') && $this->get('subcategory') != '') {
                $where .= ' AND q.subcategory=' . $this->get('subcategory');
            }
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (q.`id` like '%" . $search . "%' OR `question` like '%" . $search . "%' OR `optiona` like '%" . $search . "%' OR `optionb` like '%" . $search . "%' OR `optionc` like '%" . $search . "%' OR `optiond` like '%" . $search . "%' OR `answer` like '%" . $search . "%')";
            if ($this->get('language') && $this->get('language') != '') {
                $where .= " AND q.language_id=" . $this->get('language') . "";
                if ($this->get('category') && $this->get('category') != '') {
                    $where .= ' AND q.category=' . $this->get('category');
                    if ($this->get('subcategory') && $this->get('subcategory') != '') {
                        $where .= ' AND q.subcategory=' . $this->get('subcategory');
                    }
                }
            } else if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        }

        $join = " LEFT JOIN tbl_languages l ON l.id = q.language_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_question q $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT q.*, l.language FROM tbl_question q $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? QUESTION_IMG_PATH . $row->image : '';
            // $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="'.base_url() ."create-questions/".$row->id.'" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="Question Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : 'No Image';
            $tempRow['question_type'] = $row->question_type;
            $tempRow['question'] = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
            $tempRow['optiona'] = "<textarea class='editor-questions-inline'>" . $row->optiona . "</textarea>";
            $tempRow['optionb'] = "<textarea class='editor-questions-inline'>" . $row->optionb . "</textarea>";
            $tempRow['optionc'] = $row->optionc ? "<textarea class='editor-questions-inline'>" . $row->optionc . "</textarea>" : "<textarea class='editor-questions-inline'> - </textarea>";
            $tempRow['optiond'] = $row->optiond ? "<textarea class='editor-questions-inline'>" . $row->optiond . "</textarea>" : "<textarea class='editor-questions-inline'> - </textarea>";
            $tempRow['optione'] = $row->optione ? "<textarea class='editor-questions-inline'>" . $row->optione . "</textarea>" : "<textarea class='editor-questions-inline'> - </textarea>";
            $tempRow['note'] = $row->note ? "<textarea class='editor-questions-inline'>" . $row->note . "</textarea>" : "<textarea class='editor-questions-inline text-center'> - </textarea>";
            $tempRow['level'] = $row->level;
            $tempRow['answer'] = $row->answer;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function audio_question_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('language') && $this->get('language') != '') {
            $where = " WHERE q.language_id=" . $this->get('language') . "";
            if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        } else if ($this->get('category') && $this->get('category') != '') {
            $where = ' WHERE q.category=' . $this->get('category');
            if ($this->get('subcategory') && $this->get('subcategory') != '') {
                $where .= ' AND q.subcategory=' . $this->get('subcategory');
            }
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (q.`id` like '%" . $search . "%' OR `question` like '%" . $search . "%' OR `optiona` like '%" . $search . "%' OR `optionb` like '%" . $search . "%' OR `optionc` like '%" . $search . "%' OR `optiond` like '%" . $search . "%' OR `answer` like '%" . $search . "%')";
            if ($this->get('language') && $this->get('language') != '') {
                $where .= " AND q.language_id=" . $this->get('language') . "";
                if ($this->get('category') && $this->get('category') != '') {
                    $where .= ' AND q.category=' . $this->get('category');
                    if ($this->get('subcategory') && $this->get('subcategory') != '') {
                        $where .= ' AND q.subcategory=' . $this->get('subcategory');
                    }
                }
            } else if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        }

        $join = " LEFT JOIN tbl_languages l ON l.id = q.language_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_audio_question q $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT q.*, l.language FROM tbl_audio_question q $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            if ($row->audio_type != '1') {
                $path = base_url().QUESTION_AUDIO_PATH;
            } else {
                $path = "";
            }
            $audio = (!empty($row->audio)) ? (($row->audio_type == 2 ) ? $path . $row->audio : $row->audio) : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-audio="' . QUESTION_AUDIO_PATH.$row->audio . '"><i class="fa fa-trash"></i></a>';

            $tempRow['audio_url'] = $audio;
            $tempRow['id'] = $row->id;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['audio'] = '<audio id=' . $row->id . '><source src="' . $audio . '" type="audio/mpeg"></audio><a data-id=' . $row->id . ' class="btn btn-icon btn-sm btn-primary playbtn fa fa-play"></a>';
            $tempRow['question'] = $row->question;
            $tempRow['question_type'] = $row->question_type;
            $tempRow['audio_type'] = $row->audio_type;
            $tempRow['optiona'] = $row->optiona;
            $tempRow['optionb'] = $row->optionb;
            $tempRow['optionc'] = $row->optionc;
            $tempRow['optiond'] = $row->optiond;
            $tempRow['optione'] = $row->optione;
            $tempRow['answer'] = $row->answer;
            $tempRow['note'] = $row->note;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function subcategory_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'row_order';
        $order = 'ASC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        $type_name = $this->get('type');

        $type = $this->category_type[$type_name];
        $where = ' WHERE c.type=' . $type;

        if ($this->get('language') && $this->get('language') != '') {
            $where .= " AND s.language_id=" . $this->get('language') . "";
            if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND s.maincat_id=' . $this->get('category');
            }
        } else if ($this->get('category') && $this->get('category') != '') {
            $where = ' WHERE s.maincat_id=' . $this->get('category');
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (s.id like '%" . $search . "%' OR s.subcategory_name like '%" . $search . "%' OR l.`language` like '%" . $search . "%' OR c.`category_name` like '%" . $search . "%')";
        }

        $join = " LEFT JOIN tbl_languages l ON l.id = s.language_id";
        $join .= " JOIN tbl_category c ON c.id = s.maincat_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_subcategory s $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }

        if($type == 2){
            $no_of_que = ', (select count(id) from tbl_fun_n_learn q where q.subcategory = s.id ) as no_of_que';
        } else if($type == 3){
            // $no_of_que = ', (select count(id) from tbl_guess_the_word q where q.subcategory = s.id ) as no_of_que';
            $no_of_que = ', (select count(id) from tbl_guess_the_word q where q.subcategory = s.id ) as no_of_que';
        } else if($type == 4){
            $no_of_que = ', (select count(id) from tbl_audio_question q where q.subcategory = s.id ) as no_of_que';
        } else if ($type == 5) {
            $no_of_que = ', (select count(id) from tbl_maths_question q where q.subcategory = s.id ) as no_of_que';
        } else {
            $no_of_que = ',(select count(id) from tbl_question q where q.subcategory=s.id ) as no_of_que';
        }
        
        $query1 = $this->db->query("SELECT s.*,l.language,c.category_name $no_of_que FROM tbl_subcategory s $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();





        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? SUBCATEGORY_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['maincat_id'] = $row->maincat_id;
            $tempRow['category_name'] = $row->category_name;
            $tempRow['row_order'] = $row->row_order;
            $tempRow['subcategory_name'] = $row->subcategory_name;
            $tempRow['slug'] = $row->slug;
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="Subcategory Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : '<img src=' . $this->NO_IMAGE . ' height=30 >';
            $tempRow['is_premium'] = $row->is_premium;
            $tempRow['coins'] = $row->coins;
            $tempRow['status'] = ($row->status) ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Deactive</span>";
            $tempRow['no_of_que'] = $row->no_of_que;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function category_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'row_order';
        $order = 'ASC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        $type_name = $this->get('type');

        $type = $this->category_type[$type_name];



        $where = ' WHERE c.type=' . $type;

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $where .= " AND c.language_id=" . $language_id . "";
        }

        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (c.`id` like '%" . $search . "%' OR c.`category_name` like '%" . $search . "%' OR l.`language` like '%" . $search . "%' )";
        }

        $join = " LEFT JOIN tbl_languages l on l.id = c.language_id";

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_category c $join $where");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }
        
        if($type == 2){
            $no_of_que = ', (select count(id) from tbl_fun_n_learn q where q.category = c.id ) as no_of_que';
        } else if($type == 3){
            $no_of_que = ', (select count(id) from tbl_guess_the_word q where q.category = c.id ) as no_of_que';
        } else if($type == 4){
            $no_of_que = ', (select count(id) from tbl_audio_question q where q.category = c.id ) as no_of_que';
        } else if ($type == 5) {
            $no_of_que = ', (select count(id) from tbl_maths_question q where q.category = c.id ) as no_of_que';
        } else {
            $no_of_que = ', (select count(id) from tbl_question q where q.category = c.id ) as no_of_que';
        }

        $query1 = $this->db->query("SELECT c.*,l.language $no_of_que FROM tbl_category c $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;





        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? CATEGORY_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['row_order'] = $row->row_order;
            $tempRow['category_name'] = $row->category_name;
            $tempRow['slug'] = $row->slug;
            $tempRow['image'] = (!empty($image)) ? '<a href=' . base_url() . $image . '  data-lightbox="Category Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : '<img src=' . $this->NO_IMAGE . ' height=30 >';
            $tempRow['is_premium'] = $row->is_premium;
            $tempRow['coins'] = $row->coins;
            $tempRow['no_of_que'] = $row->no_of_que;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function languages_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = ' WHERE type=1';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (id like '%" . $search . "%' OR language like '%" . $search . "%')";
        }

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_languages $where ");
        $res1 = $query->result();
        foreach ($res1 as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT * FROM tbl_languages  $where  ORDER BY  $sort  $order  LIMIT  $offset , $limit");
        $res = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;

        foreach ($res as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' ><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['language'] = $row->language;
            $tempRow['code'] = $row->code;
            $tempRow['status'] = ($row->status) ? "<span class='badge badge-success'>Enabled</span>" : "<span class='badge badge-danger'>Disabled</span>";
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function upload_langauge_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');


        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (id like '%" . $search . "%' OR name like '%" . $search . "%')";
        }

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_upload_languages $where ");
        $res1 = $query->result();
        foreach ($res1 as $row1) {
            $total = $row1->total;
        }

        $query1 = $this->db->query("SELECT * FROM tbl_upload_languages  $where  ORDER BY  $sort  $order  LIMIT  $offset , $limit");
        $res = $query1->result();
        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;





        foreach ($res as $row) {
            $file = (!empty($row->file)) ? LANGUAGE_FILE_PATH . $row->file : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-file="' . $file . '"><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['language_name'] = $row->name;
            $tempRow['file'] = (!empty($file)) ? '<a href=' . base_url() . $file .' target="_blank">'.$row->file .'</a>' : '';
            $tempRow['file_url'] = $file;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function coin_store_get() {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('search')) {
            $search = $this->get('search');
            $where = " WHERE (id like '%" . $search . "%' OR title like '%" . $search . "%' OR coins like '%" . $search . "%' OR product_id like '%" . $search . "%' OR description like '%" . $search . "%')";
        }

        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_coin_store $where");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }
        

        $query1 = $this->db->query("SELECT * FROM tbl_coin_store $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? COIN_STORE_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary status-update" data-id=' . $row->id . ' data-toggle="modal" data-target="#updateStatusModal" title="Edit"><i class="fa fa-toggle-on"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image='.$image.' ><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['title'] = $row->title;
            $tempRow['coins'] = $row->coins;
            $tempRow['product_id'] = $row->product_id;
            $tempRow['description'] = $row->description;
            $tempRow['image_url'] = $image;
            $tempRow['status'] = ($row->status) ? "<label class='badge badge-success'>Active</label>" : "<label class='badge badge-danger'>Deactive</label>";
            $tempRow['status_db'] = $row->status;
            $tempRow['image'] = (!empty($image)) ? '<a href=' . base_url() . $image . '  data-lightbox="Coin Store Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : '<img src=' . $this->NO_IMAGE . ' height=30 >';
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }
    public function question_without_premium_get()
    {
        $offset = 0;
        $limit = 10;
        $sort = 'id';
        $order = 'DESC';
        $where = '';
        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');
        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');
        $join = " LEFT JOIN tbl_languages l ON l.id = q.language_id LEFT JOIN tbl_category as c on c.id = q.category LEFT JOIN tbl_subcategory as sc on sc.id = q.subcategory where c.is_premium = 0 and sc.is_premium = 0";
        if ($this->get('language') && $this->get('language') != '') {
            $where = " AND q.language_id=" . $this->get('language') . "";
            if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        } else if ($this->get('category') && $this->get('category') != '') {
            $where = ' AND q.category=' . $this->get('category');
            if ($this->get('subcategory') && $this->get('subcategory') != '') {
                $where .= ' AND q.subcategory=' . $this->get('subcategory');
            }
        }
        if ($this->get('search')) {
            $search = $this->get('search');
            $where .= " AND (q.id like '%" . $search . "%' OR q.question like '%" . $search . "%' OR q.optiona like '%" . $search . "%' OR q.optionb like '%" . $search . "%' OR q.optionc like '%" . $search . "%' OR q.optiond like '%" . $search . "%' OR q.optione like '%" . $search . "%' OR answer like '%" . $search . "%')";
            if ($this->get('language') && $this->get('language') != '') {
                $where .= " AND q.language_id=" . $this->get('language') . "";
                if ($this->get('category') && $this->get('category') != '') {
                    $where .= ' AND q.category=' . $this->get('category');
                    if ($this->get('subcategory') && $this->get('subcategory') != '') {
                        $where .= ' AND q.subcategory=' . $this->get('subcategory');
                    }
                }
            } else if ($this->get('category') && $this->get('category') != '') {
                $where .= ' AND q.category=' . $this->get('category');
                if ($this->get('subcategory') && $this->get('subcategory') != '') {
                    $where .= ' AND q.subcategory=' . $this->get('subcategory');
                }
            }
        }
        $query = $this->db->query("SELECT COUNT(*) as total FROM tbl_question q $join $where ");
        $res = $query->result();
        foreach ($res as $row1) {
            $total = $row1->total;
        }
        $query1 = $this->db->query("SELECT q.*, l.language FROM tbl_question q $join $where ORDER BY $sort $order LIMIT $offset , $limit");
        $res1 = $query1->result();
        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        $count = 1;
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="Edit"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '"><i class="fa fa-trash"></i></a>';
            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="Question Images"><img src=' . base_url() . $image . ' height=50, width=50 >' : 'No Image';
            $tempRow['question_type'] = $row->question_type;
            $tempRow['question'] = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
            $tempRow['answer'] = $row->answer;
            $tempRow['level'] = $row->level;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }
        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }


}
