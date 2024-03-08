<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

    public function index() {
        $this->result['count_category'] = $this->db->count_all('tbl_category');
        $this->result['count_subcategory'] = $this->db->count_all('tbl_subcategory');
        $this->result['count_question'] = $this->db->count_all('tbl_question');
        $this->result['count_user'] = $this->db->count_all('tbl_users');
        $this->result['count_live_contest'] = $this->db->where('start_date<=', $this->toDate)->where('end_date>', $this->toDate)->count_all_results('tbl_contest');
        $this->result['count_fun_n_learn'] = $this->db->count_all('tbl_fun_n_learn');
        $this->result['count_guess_the_word'] = $this->db->count_all('tbl_guess_the_word');
        $this->result['count_system_user'] = $this->db->where('status', 0)->count_all_results('tbl_authenticate');

        $year_data = $this->db->query("SELECT DISTINCT YEAR(date_registered) as year FROM tbl_users")->result();
        $this->result['years'] = array();
        foreach ($year_data as $row) {
            $this->result['years'][] = $row->year;
        }

        $this->result['month_data'] = $this->db->query("SELECT m.name as month_name, (SELECT COUNT(id) AS user_count FROM tbl_users WHERE YEAR(date_registered) = YEAR('" . $this->toDate . "') AND MONTHNAME(date_registered) = m.name GROUP BY MONTH(date_registered)) as user_count FROM tbl_month_week m WHERE m.type=1")->result();
        $this->result['week_data'] = $this->db->query("SELECT m.name as day_name, (SELECT COUNT(id) AS user_count FROM tbl_users WHERE YEAR(date_registered) = YEAR('" . $this->toDate . "') AND MONTH(date_registered) = MONTH('" . $this->toDate . "') AND DAYNAME(date_registered) = m.name GROUP BY DAYOFWEEK(date_registered)) as user_count FROM tbl_month_week m WHERE m.type=2")->result();
        $this->result['day_data'] = $this->db->query("SELECT COUNT(id) AS user_count, DAYOFMONTH(date_registered) AS day_name FROM tbl_users WHERE YEAR(date_registered) = YEAR('" . $this->toDate . "') AND MONTH(date_registered) = MONTH('" . $this->toDate . "') GROUP BY DATE(date_registered)")->result();

        // $this->result['month_data'] = $this->db->query("SELECT m.name as month_name, (SELECT COUNT(id) AS user_count FROM tbl_users WHERE YEAR(date_registered) = YEAR(CURRENT_DATE) AND MONTHNAME(date_registered) = m.name GROUP BY MONTH(date_registered)) as user_count FROM tbl_month_week m WHERE m.type=1")->result();
        // $this->result['week_data'] = $this->db->query("SELECT m.name as day_name, (SELECT COUNT(id) AS user_count FROM tbl_users WHERE YEAR(date_registered) = YEAR(CURRENT_DATE) AND DAYNAME(date_registered) = m.name GROUP BY DAYOFWEEK(date_registered)) as user_count FROM tbl_month_week m WHERE m.type=2")->result();
        // $this->result['day_data'] = $this->db->query("SELECT COUNT(id) AS user_count, DAYOFMONTH(date_registered) AS day_name FROM tbl_users WHERE YEAR(date_registered) = YEAR(CURRENT_DATE) AND MONTH(date_registered) = MONTH(CURRENT_DATE) GROUP BY DATE(date_registered)")->result();


        $this->load->view('dashboard', $this->result);
    }

    public function edit_accounts_rights() {
        if (!$this->session->userdata('authStatus')) {
            redirect('/');
        } else {
            $id = $this->input->post('id');
            $this->result['fetched_data'] = $this->User_model->get_user_rights($id);
            $this->result['system_modules'] = $this->config->item('system_modules');
            $this->load->view('edit_accounts_rights', $this->result, false);
        }
    }

    public function users_accounts_rights() {
        if (!$this->session->userdata('authStatus')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'users_accounts_rights')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else{
                $username = $this->input->post('username');
                $data = $this->db->where('auth_username', $username)->get('tbl_authenticate')->result();
                if (!empty($data)) {
                    $this->session->set_flashdata('error', $username . ' is already exists.!');
                } else {
                    $this->User_model->add_user_rights();
                    $this->session->set_flashdata('success', 'User created successfully.! ');
                }
            }
                redirect('user-accounts-rights', 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('create', 'users_accounts_rights')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {

                $this->User_model->update_user_rights();
                $this->session->set_flashdata('success', 'User updated  successfully.!');
                redirect('user-accounts-rights', 'refresh');
                }
            }
            $this->result['system_modules'] = $this->config->item('system_modules');
            $this->load->view('users_accounts_rights', $this->result);
        }
    }

    public function battle_statistics($id) {
        $this->result['general_stat'] = $this->User_model->general_statistics($id);
        $this->result['battle_stat'] = $this->User_model->battle_statistics($id);
        $this->load->view('battle_statistics', $this->result);
    }

    public function global_leaderboard() {
        $this->load->view('leaderboard_global', $this->result);
    }

    public function monthly_leaderboard() {
        $this->load->view('leaderboard_monthly', $this->result);
    }

    public function daily_leaderboard() {
        $this->load->view('leaderboard_daily', $this->result);
    }

    public function get_subcategories_of_category() {
        $category_id = $this->input->post('category_id');
        $data = $this->db->where('maincat_id', $category_id)->where('status', 1)->order_by('row_order', 'ASC')->get('tbl_subcategory')->result();
        if ($this->input->post('sortable')) {
            $options = '';
            foreach ($data as $option) {
                if (!empty($option->image)) {
                    $options .= "<li id='" . $option->id . "'><img src='" . SUBCATEGORY_IMG_PATH . $option->image . "' height=30 > " . $option->subcategory_name . "</li>";
                } else {
                    $options .= "<li id='" . $option->id . "'><img src='" . $this->NO_IMAGE . "' height=30 > " . $option->subcategory_name . "</li>";
                }
            }
        } else {
            $options = '<option value="">Select Sub Category</option>';
            foreach ($data as $option) {
                $optionName = $option->is_premium == 1 ? $option->subcategory_name.' - Premium' : $option->subcategory_name;
                $options .= "<option value=" . $option->id . " data-is-premium='".$option->is_premium."'>" . $optionName . "</option>";
            }
        }
        echo $options;
    }

    public function get_categories_of_language() {

        $type_name = $this->input->post('type');
        $type = $this->category_type[$type_name];
        if ($this->input->post('language_id')) {
            $language_id = $this->input->post('language_id');
            $this->db->where('language_id', $language_id);
        }
        $data = $this->db->where('type', $type)->order_by('row_order', 'ASC')->get('tbl_category')->result();
        if ($this->input->post('sortable')) {
            $options = '';
            foreach ($data as $option) {
                if (!empty($option->image)) {
                    $options .= "<li id='" . $option->id . "'><img src='" . CATEGORY_IMG_PATH . $option->image . "' height=30 > " . $option->category_name . "</li>";
                } else {
                    $options .= "<li id='" . $option->id . "'><img src='" . $this->NO_IMAGE . "' height=30 > " . $option->category_name . "</li>";
                }
            }
        } else {
            $options = '<option value="">Select Main Category</option>';
            foreach ($data as $option) {
                $optionName = $option->is_premium == 1 ? $option->category_name.' - Premium' : $option->category_name;
                $options .= "<option value=" . $option->id . " data-is-premium='".$option->is_premium."'>" . $optionName . "</option>";
            }
        }
        echo $options;
    }

    public function delete_multiple() {
        $ids = $this->input->post('ids');
        $table = $this->input->post('sec');
        $is_image = $this->input->post('is_image');
        $data = $this->Setting_model->delete_multiple($ids, $is_image, $table);
        echo $data;
    }

    public function users() {
        if (!has_permissions('read', 'users')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'users')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {

                    $this->User_model->update_user();

                    $this->session->set_flashdata('success', 'User updated successfully.!');
                    redirect('users', 'refresh');
                }
            }

            if ($this->input->post('btnupdateCoins')) {
                
                if (!has_permissions('update', 'users')) {
                    $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                } else {
                    $this->User_model->update_user_coin();
            
                    $this->session->set_flashdata('success', 'User Coins Added successfully.!');
                 
                    redirect('users', 'refresh');
                }

            }

            $this->load->view('users', $this->result);
        }
    }

    public function delete_accounts_rights() {
        if (!has_permissions('delete', 'delete_accounts_rights')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $this->User_model->delete_user_rights($id);
            echo TRUE;
        }
    }

    public function getYearForMonthChart($year){
        $queryData = $this->result['month_data'] = $this->db->query("SELECT m.name as month_name, (SELECT COUNT(id) AS user_count FROM tbl_users WHERE YEAR(date_registered) = $year AND MONTHNAME(date_registered) = m.name GROUP BY MONTH(date_registered)) as user_count FROM tbl_month_week m WHERE m.type=1")->result();
        $mLable = $mData = array();
        foreach ($queryData as $mD) {
            $mLable[] = $mD->month_name;
            $mData[] = ($mD->user_count == NULL) ? 0 : (int) $mD->user_count;
        }
        $maxMonthData = $mData ? max($mData) : 0;
        $stepSizeMonth = $maxMonthData > 10 ? round($maxMonthData / 10) : 1; // Change 10 to the number of steps you want

        $data['mName'] = $mLable;
        $data['mD'] = $mData;
        $data['stepSizeMonth'] = $stepSizeMonth;
        
        echo json_encode($data);
    }


    
    

}