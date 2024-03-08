<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->toDate = date('Y-m-d');
        $this->toDateTime = date('Y-m-d H:i:s');
    }

    public function add_notification() {
        $title = $this->input->post('title');
        $message = $this->input->post('message');
        $users = $this->input->post('users');
        $type = $this->input->post('type');
        if ($type == 'category') {
            $maincat_id = $this->input->post('maincat_id');
            $res = $this->db->select('max(level)as maxlevel')->where('category', $maincat_id)->get('tbl_question')->result_array();
            $maxlevel = $res[0]['maxlevel'];

            $res1 = $this->db->select('count(id) as no_of')->where('maincat_id', $maincat_id)->where('status', 1)->get('tbl_subcategory')->result_array();
            $no_of = $res1[0]['no_of'];
        } else {
            $maxlevel = 0;
            $maincat_id = 0;
            $no_of = 0;
        }

        if ($_FILES['file']['name'] == '') {
            $frm_data = array(
                'title' => $title,
                'message' => $message,
                'users' => $users,
                'type' => $type,
                'type_id' => $maincat_id,
                'image' => '',
                'date_sent' => $this->toDateTime
            );
            $this->db->insert('tbl_notifications', $frm_data);
            $fcmMsg = array(
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'title' => $title,
//                'message' => $message,
                'body' => $message,
                'image' => null,
                'type' => $type,
                'type_id' => $maincat_id,
                'maxlevel' => $maxlevel,
                'no_of' => $no_of
            );
        } else {
            // create folder 
            if (!is_dir(NOTIFICATION_IMG_PATH)) {
                mkdir(NOTIFICATION_IMG_PATH, 0777, TRUE);
            }
            $image = time();
            $config['upload_path'] = NOTIFICATION_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_TYPES;
            $config['file_name'] = $image;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                return FALSE;
            } else {
                $data = $this->upload->data();
                $img = $data['file_name'];
                //Setting values for tabel columns
                $frm_data = array(
                    'title' => $title,
                    'message' => $message,
                    'users' => $users,
                    'type' => $type,
                    'type_id' => $maincat_id,
                    'image' => $img,
                    'date_sent' => $this->toDateTime
                );
                $this->db->insert('tbl_notifications', $frm_data);
                $fcmMsg = array(
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    'title' => $title,
//                    'message' => $message,
                    'body' => $message,
                    'image' => base_url() . NOTIFICATION_IMG_PATH . $img,
                    'type' => $type,
                    'type_id' => $maincat_id,
                    'maxlevel' => $maxlevel,
                    'no_of' => $no_of
                );
            }
        }
//      $newMsg['data'] = $fcmMsg;
        //notification 
        $data = $this->db->where('type', 'fcm_server_key')->get('tbl_settings')->row_array();
        define('API_ACCESS_KEY', $data['message']);

        if ($users == 'all') {
            $res = $this->db->select("fcm_id")->get("tbl_users")->result_array();
            $fcm_ids = array();
            foreach ($res as $fcm_id) {
                $fcm_ids[] = $fcm_id['fcm_id'];
            }
        } elseif ($users == 'selected') {
            $selected_list = $this->input->post('selected_list');
            if (empty($selected_list)) {
                $response['error'] = true;
                $response['message'] = 'Please Select the users from the table';
                echo json_encode($response);
                return false;
            }
            $fcm_ids = array();
            $fcm_ids = explode(",", $selected_list);
        }

        $registrationIDs = $fcm_ids;
//      print_r($registrationIDs);

        $registrationIDs_chunks = array_chunk($registrationIDs, 1000);
        log_message('error', json_encode($registrationIDs_chunks));
        // print_r($registrationIDs_chunks);
        $success = $failure = 0;

        foreach ($registrationIDs_chunks as $registrationIDs) {
            $fcmFields = array(
                'registration_ids' => $registrationIDs, // expects an array of ids
                'priority' => 'high',
                'notification' => $fcmMsg,
                'data' => $fcmMsg
            );
            //print_r(json_encode($fcmFields));
            $headers = array(
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
            $result = curl_exec($ch);

            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
            //Now close the connection
            curl_close($ch);
        }
        // return $result;
//        log_message('error', $result);
    }

    public function delete_notification($id, $image_url) {
        //Delete image from folder 
        if (file_exists($image_url)) {
            unlink($image_url);
        }
        $this->db->where('id', $id)->delete('tbl_notifications');
    }

}
