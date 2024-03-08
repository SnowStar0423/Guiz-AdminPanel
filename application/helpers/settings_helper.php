<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('get_user_permissions')) {

    function get_user_permissions($id) {
        $SH = & get_instance();
        $SH->load->database();
        $userData = $SH->db->where('auth_id', $id)->get('tbl_authenticate')->row_array();
        return $userData;
    }

}

if (!function_exists('is_modification_allowed')) {

    function is_modification_allowed($module) {
        $t = & get_instance();

        //if user is superadmin then allow modifications
        if($t->session->userdata('authName')=='superadmin'){
            return true;
        }
        $allow_modification = ALLOW_MODIFICATION;

        

        // print_r($t->session->userdata());
        
        $allow_modification = ($allow_modification == 0) ? 0 : 1;
        if (isset($allow_modification) && $allow_modification == 0) {
            return false;
        }
        return true;
    }

}

if (!function_exists('has_permissions')) {

    function has_permissions($role, $module) {
        $role = trim($role);
        $module = trim($module);

        if (!is_modification_allowed($module) && in_array($role, ['create', 'update', 'delete'])) {
            return false; //Modification not allowed
        }
        $t = &get_instance();
        $id = $t->session->userdata('authId');
        $t->load->config('quiz');
        $general_system_permissions = $t->config->item('system_modules');
        $userData = get_user_permissions($id);
        if (!empty($userData)) {

            if (intval($userData['status']) == 0) {
                $permissions = json_decode($userData['permissions'], 1);
                if (array_key_exists($module, $general_system_permissions) && array_key_exists($module, $permissions)) {
                    if (array_key_exists($module, $permissions)) {
                        if (in_array($role, $general_system_permissions[$module])) {
                            if (!array_key_exists($role, $permissions[$module])) {
                                return false; //User has no permission
                            }
                        }
                    }
                } else {
                    return false; //User has no permission
                }
            }
            return true; //User has permission
        }
    }

}

if (!function_exists('is_settings')) {

    function is_settings($type) {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('type', $type)->get('tbl_settings')->row_array();
        if (!empty($res)) {
            if (isset($res['message']))
                return $res['message'];
            else
                return false;
        } else {
            return false;
        }
    }

}

if (!function_exists('is_language_mode_enabled')) {

    function is_language_mode_enabled() {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('type', 'language_mode')->get('tbl_settings')->row_array();
        if (!empty($res)) {
            if (isset($res['message']) && $res['message'] == 1)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

}

if (!function_exists('is_option_e_mode_enabled')) {

    function is_option_e_mode_enabled() {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('type', 'option_e_mode')->get('tbl_settings')->row_array();
        if (!empty($res)) {
            if (isset($res['message']) && $res['message'] == 1)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

}

if (!function_exists('get_system_timezone')) {

    function get_system_timezone() {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('type', 'system_timezone')->get('tbl_settings')->row_array();
        if (!empty($res)) {
            if (isset($res['message']))
                return $res['message'];
            else
                return 'Asia/Kolkata';
        } else {
            return 'Asia/Kolkata';
        }
    }

}

if (!function_exists('is_refer_code_set')) {

    function is_refer_code_set($user_id) {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('id', $user_id)->get('tbl_users')->row_array();

        if (!empty($res['refer_code'])) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('credit_coins_to_friends_code')) {

    function credit_coins_to_friends_code($friends_code) {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('refer_code', $friends_code)->get('tbl_users')->row_array();

        $earn_coin = is_settings('earn_coin');
        $net_coins = $res['coins'] + $earn_coin;
        $data = array(
            'coins' => $net_coins
        );
        $SH->db->where('refer_code', $friends_code)->update('tbl_users', $data);
        
        $response['user_id'] = $res['id'];
        $response['coins'] = $net_coins;
        $response['credited'] = true;
        return $response;
    }

}

if (!function_exists('check_friends_code_is_used_by_user')) {

    function check_friends_code_is_used_by_user($user_id) {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('id', $user_id)->get('tbl_users')->row_array();
        if (!empty($res['friends_code'])) {
            $response['is_used'] = true;
        } else {
            $response['is_used'] = false;
        }
        return $response;
    }

}

if (!function_exists('valid_friends_refer_code')) {

    function valid_friends_refer_code($friends_code) {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('refer_code', $friends_code)->get('tbl_users')->row_array();
        if ($res) {
            $response['is_valid'] = true;
            $response['user_id'] = $res['id'];
            $response['name'] = $res['name'];
            $response['email'] = $res['email'];
        } else {
            $response['is_valid'] = false;
        }
        return $response;
    }

}

if (!function_exists('is_battle_category_mode_enabled')) {

    function is_battle_category_mode_enabled() {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('type', 'battle_category_mode')->get('tbl_settings')->row_array();
        if (!empty($res)) {
            if (isset($res['message']) && $res['message'] == 1)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

}

if (!function_exists('is_room_category_mode_enabled')) {

    function is_room_category_mode_enabled() {
        $SH = & get_instance();
        $SH->load->database();
        $res = $SH->db->where('type', 'room_category_mode')->get('tbl_settings')->row_array();
        if (!empty($res)) {
            if (isset($res['message']) && $res['message'] == 1)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

}
?>