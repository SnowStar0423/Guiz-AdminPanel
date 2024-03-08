<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elite_Cron_Job extends CI_Controller {
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        date_default_timezone_set(get_system_timezone());
    }
    
    /**
     * This function is used to update the age of users automatically
     * This function is called by cron job once in a day at midnight 00:00
     */
    public function index() {            
        $res = $this->db->get('tbl_exam_module')->result_array();
        if(!empty($res)){
            // print_r($res);
            $data = [
                    'date' => date('Y-m-d'),
                    'status'=>1
            ];
            $this->db->update('tbl_exam_module', $data);
         
            log_message('error', ' Exam Module Cronjob Time -'.date('Y-m-d H:i:s'));
        }
         $res1 = $this->db->get('tbl_daily_quiz')->result_array();
          if(!empty($res1)){
         
            // echo $this->db->last_query();
            // echo 'done';
            $data1 = [
                    'date_published' => date('Y-m-d'),
                    
            ];
            $this->db->update('tbl_daily_quiz', $data1);
            log_message('error', 'Daily quiz Cronjob Time-'.date('Y-m-d H:i:s'));
        }
        
        
    }
}
?>