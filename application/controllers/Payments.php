<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->helper('password_helper');
        $this->load->config('quiz');
        date_default_timezone_set(get_system_timezone());

        $this->category_type = $this->config->item('category_type');

        $this->toDate = date('Y-m-d');

        $this->result['full_logo'] = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
        $this->result['half_logo'] = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
        $this->result['app_name'] = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();

        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();

        $this->NO_IMAGE = base_url() . LOGO_IMG_PATH . $this->result['half_logo']['message'];
    }

    
    public function activity_tracker(){
        if (!has_permissions('read', 'activity_tracker')) {
            redirect('/', 'refresh');
        } else {
            $this->load->view('activity_tracker', $this->result);
        }
    }

    public function payment_settings(){
        if (!has_permissions('read', 'payment_settings')) {
            redirect('/', 'refresh');
        } else {
            $settings = [
                'payment_mode', 'payment_message',
                'per_coin', 'coin_amount','currency_symbol', 'coin_limit','difference_hours'
            ];
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'payment_settings')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {        
                    foreach ($settings as $type) {
                        $message = $this->input->post($type);
                        $res = $this->db->where('type', $type)->get('tbl_settings')->row_array();
                        if ($res) {
                            $data = ['message' => $message];
                            $this->db->where('type', $type)->update('tbl_settings', $data);
                        } else {
                            $data = array(
                                'type' => $type,
                                'message' => $message
                            );
                            $this->db->insert('tbl_settings', $data);
                        }
                    }
                    $this->session->set_flashdata('success', 'Settings Update successfully.!');
                    redirect('payment-settings', 'refresh');
                }
            }
          
            foreach ($settings as $row) {
                $data = $this->db->where('type', $row)->get('tbl_settings')->row_array();
                $this->result[$row] = $data;
            }
            $this->load->view('payment_settings', $this->result);
        }        
    }

    public function payment_requests(){
        if (!has_permissions('read', 'payment_requests')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                $multiple_ids = $this->input->post('multiple_ids');
                // $multiple_ids = explode(',', $multiple_ids);
                if (!has_permissions('create', 'payment_settings')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    if($multiple_ids == ''){
                        $this->session->set_flashdata('error', 'Please select some records');
                    } else {
                        $status = $this->input->post('status');
                        $this->db->query("UPDATE tbl_payment_request SET `status`='$status' WHERE id in ( " . $multiple_ids . " ) ");
                        $this->session->set_flashdata('success', 'Updated successfully.!');
                    }                   
                }
                redirect('payment-requests', 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'payment_settings')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {     
                    $edit_id = $this->input->post('edit_id'); 
                    $firebase_id = $this->input->post('uid'); 
                    $user_id = $this->input->post('edit_user_id');                     
                    $status = $this->input->post('status'); 
                    $details = $this->input->post('details');
                    $coins = $this->input->post('coin_used');    

                    $res = $this->db->where('id', $edit_id)->get('tbl_payment_request')->row_array();
                    if($res['status'] == 2){
                        $this->session->set_flashdata('error', "Oops! Can not update status. Once its done.");
                    } else {
                        $user_res = $this->db->where('id', $user_id)->get('tbl_users')->row_array();
                        $fcm_id = $user_res['fcm_id'];
                        if($status == 2){    
                            $net_coins = $user_res['coins'] + $coins;
                            $data = [
                                'coins' => $net_coins
                            ];
                            $this->db->where('id', $user_id)->update('tbl_users', $data);

                            $tracker_data = [
                                'user_id' => $user_id,
                                'uid' => $firebase_id,
                                'points' => $coins,
                                'type' => 'redeemedAmount',
                                'status' => 0,
                                'date' => $this->toDate
                            ];
                            $this->db->insert('tbl_tracker', $tracker_data);
                        }
                        $data = [
                            'details' => $details,
                            'status' => $status
                        ];
                        $this->db->where('id', $edit_id)->update('tbl_payment_request', $data);
                        
                        if ($status == 1  || $status == 2) {
                            // send notification                           
                            if($status == 1){
                                $title = 'Payment Request Complete';
                                $message = "Your Payment is Complete..You have used " . $coins . " Points. Thank You!!!";
                            }
                            if($status == 2){
                                $title = 'Payment Details is Wrong';
                                $message = "Your Payment Details is Wrong..we have Refund Your " . $coins . " Points. Thank You!!!";
                            }

                            $fcmMsg = array(
                                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                                'type' => 'payment_request',
                                'title' => $title,
                                'body' => $message,
                                'coins' => $coins
                            );
                            if($fcm_id != ''){
                                $fcm_ids = array();
                                array_push($fcm_ids, $fcm_id);                               
                               
                                $this->send_notification($fcm_ids, $fcmMsg);
                            }                            
                        }                        
                        $this->session->set_flashdata('success', 'Updated successfully.!');
                    }
                    redirect('payment-requests', 'refresh');
                }
            }
            $this->load->view('payment_requests', $this->result);
        }
    }

    public function send_notification($registrationIDs, $fcmMsg){

        $data = $this->db->where('type', 'fcm_server_key')->get('tbl_settings')->row_array();
        define('API_ACCESS_KEY', $data['message']);

        $success = $failure = 0;
        $registrationIDs_chunks = array_chunk($registrationIDs, 1000);

        foreach ($registrationIDs_chunks as $registrationIDs) {
            $fcmFields = array(
                // 'to' => $singleID,
                'registration_ids' => $registrationIDs, // expects an array of ids
                'priority' => 'high',
                'notification' => $fcmMsg,
                'data' => $fcmMsg
            );

            $headers = array(
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
            $result = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($result, 1);

            $success += $result['success'];
            $failure += $result['failure'];
        }
    }

}
?>