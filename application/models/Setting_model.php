<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

    public function get_quiz_list() {
        return $this->db->order_by('id', 'ASC')->get('tbl_quiz_list')->result();
    }

    
    public function firebase_configurations(){
        $config['upload_path'] = 'assets';
        $config['allowed_types'] = 'json';
        $config['file_name'] = 'firebase_config';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $old_file = 'assets/firebase_config.json';
        if (file_exists($old_file)) {
            unlink($old_file);
        }

        if (!$this->upload->do_upload('file')) {
            return FALSE;
        } else {            
            $data = $this->upload->data();
            return TRUE;
        }
    }


    public function update_system_utility(){
        $settings = [
          'maximum_winning_coins','minimum_coins_winning_percentage','score','quiz_zone_duration',
          'self_challange_max_minutes','guess_the_word_seconds','maths_quiz_seconds',
          'fun_and_learn_time_in_seconds','audio_seconds','random_battle_seconds',
          'welcome_bonus_coin','lifeline_deduct_coin','random_battle_entry_coin','guess_the_word_max_winning_coin','review_answers_deduct_coin',
          'quiz_winning_percentage'
        ];

    
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
    }

    public function update_settings() {

        $settings = [
            'system_timezone', 'system_timezone_gmt',
            'app_link', 'more_apps',
            'ios_app_link', 'ios_more_apps',
            'refer_coin', 'earn_coin', 'app_version', 'app_version_ios', 'force_update',
            'true_value', 'false_value', 'shareapp_text', 'app_maintenance',
            'answer_mode', 'language_mode', 'option_e_mode', 'quiz_zone_mode','daily_quiz_mode', 'contest_mode', 'self_challenge_mode',
            'battle_random_category_mode', 'battle_group_category_mode', 'fun_n_learn_question', 'guess_the_word_question', 'exam_module',
            'fix_question', 'total_question', 'audio_mode_question', 'total_audio_time', 'in_app_purchase_mode',
            'maths_quiz_mode','battle_mode_one','battle_mode_group', 'true_false_mode'
            
        ];

        if(isset($type['coins'])){
            $settings[]='coins';
        }

        if(isset($type['score'])){
            $settings[]='score';
        }
        
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
    }

    public function update_ads() {
        $settings = [
            'in_app_ads_mode', 'ads_type',
            'android_banner_id', 'android_interstitial_id', 'android_rewarded_id',
            'ios_banner_id', 'ios_interstitial_id', 'ios_rewarded_id',
            'android_game_id','ios_game_id','daily_ads_visibility','daily_ads_coins','daily_ads_counter','reward_coin'
        ];

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
    }

    public function update_profile() {

        $app_name = $this->input->post('app_name');
        $name = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();
        if ($name) {
            $frm_name = ['message' => $app_name];
            $this->db->where('type', 'app_name')->update('tbl_settings', $frm_name);
        } else {
            $frm_name = array(
                'type' => 'app_name',
                'message' => $app_name
            );
            $this->db->insert('tbl_settings', $frm_name);
        }

        $jwt_key = $this->input->post('jwt_key');
        $j_key = $this->db->where('type', 'jwt_key')->get('tbl_settings')->row_array();
        if ($j_key) {
            $frm_jwt_key = ['message' => $jwt_key];
            $this->db->where('type', 'jwt_key')->update('tbl_settings', $frm_jwt_key);
        } else {
            $frm_jwt_key = array(
                'type' => 'jwt_key',
                'message' => $jwt_key
            );
            $this->db->insert('tbl_settings', $frm_jwt_key);
        }

        $full_url = $this->input->post('full_url');
        $half_url = $this->input->post('half_url');
        $background_file = $this->input->post('background_file');
        $bot_image = $this->input->post('bot_file');

        if ($_FILES['full_file']['name'] != '' && $_FILES['half_file']['name'] != '') {
            //Full logo upload
            $config = array();
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config, 'fullupload'); // Create custom object for cover upload
            $this->fullupload->initialize($config);

            // half logo upload
            $config1 = array();
            $config1['upload_path'] = LOGO_IMG_PATH;
            $config1['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config1['file_name'] = time();
            $this->load->library('upload', $config1, 'halfupload');  // Create custom object for catalog upload
            $this->halfupload->initialize($config1);

            // Check uploads success
            if ($this->fullupload->do_upload('full_file') && $this->halfupload->do_upload('half_file')) {

                // Data of your full logo file
                $full_data = $this->fullupload->data();
                $full_file = $full_data['file_name'];

                if (file_exists($full_url)) {
                    unlink($full_url);
                }

                // Data of your half logo file
                $half_data = $this->halfupload->data();
                $half_file = $half_data['file_name'];

                if (file_exists($half_url)) {
                    unlink($half_url);
                }

                $Flogo = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
                if ($Flogo) {
                    $frm_Flogo = ['message' => $full_file];
                    $this->db->where('type', 'full_logo')->update('tbl_settings', $frm_Flogo);
                } else {
                    $frm_Flogo = array(
                        'type' => 'full_logo',
                        'message' => $full_file
                    );
                    $this->db->insert('tbl_settings', $frm_Flogo);
                }

                $Hlogo = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
                if ($Hlogo) {
                    $frm_Hlogo = ['message' => $half_file];
                    $this->db->where('type', 'half_logo')->update('tbl_settings', $frm_Hlogo);
                } else {
                    $frm_Hlogo = array(
                        'type' => 'half_logo',
                        'message' => $half_file
                    );
                    $this->db->insert('tbl_settings', $frm_Hlogo);
                }
                return TRUE;
            } else {
                return FALSE;
            }
        }

        if ($_FILES['full_file']['name'] != '' && $_FILES['half_file']['name'] == '') {
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('full_file')) {
                return FALSE;
            } else {
                if (file_exists($full_url)) {
                    unlink($full_url);
                }

                $data = $this->upload->data();
                $img = $data['file_name'];
                $logo = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
                if ($logo) {
                    $frm_logo = ['message' => $img];
                    $this->db->where('type', 'full_logo')->update('tbl_settings', $frm_logo);
                } else {
                    $frm_logo = array(
                        'type' => 'full_logo',
                        'message' => $img
                    );
                    $this->db->insert('tbl_settings', $frm_logo);
                }
                return TRUE;
            }
        }

        if ($_FILES['half_file']['name'] != '' && $_FILES['full_file']['name'] == '') {
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('half_file')) {
                return FALSE;
            } else {
                if (file_exists($half_url)) {
                    unlink($half_url);
                }
                $data = $this->upload->data();
                $img = $data['file_name'];
                $logo = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
                if ($logo) {
                    $frm_logo = ['message' => $img];
                    $this->db->where('type', 'half_logo')->update('tbl_settings', $frm_logo);
                } else {
                    $frm_logo = array(
                        'type' => 'half_logo',
                        'message' => $img
                    );
                    $this->db->insert('tbl_settings', $frm_logo);
                }
                return TRUE;
            }
        }


        if ($_FILES['background_file']['name'] != '') {
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = "background-image";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('background_file')) {
                return FALSE;
            } else {
                if (file_exists($background_file)) {
                    unlink($background_file);
                }

                $data = $this->upload->data();
                $img = $data['file_name'];
                $logo = $this->db->where('type', 'background_file')->get('tbl_settings')->row_array();
                if ($logo) {
                    $frm_logo = ['message' => $img];
                    $this->db->where('type', 'background_file')->update('tbl_settings', $frm_logo);
                } else {
                    $frm_logo = array(
                        'type' => 'background_file',
                        'message' => $img
                    );
                    $this->db->insert('tbl_settings', $frm_logo);
                }
                return TRUE;
            }
        }


        if ($_FILES['bot_image']['name'] != '') {
            $config['upload_path'] = LOGO_IMG_PATH;
            $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
            $config['file_name'] = "bot-image";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('bot_image')) {
                return FALSE;
            } else {
                if (file_exists($bot_image)) {
                    unlink($bot_image);
                }

                $data = $this->upload->data();
                $img = $data['file_name'];
                $logo = $this->db->where('type', 'bot_image')->get('tbl_settings')->row_array();
                if ($logo) {
                    $frm_logo = ['message' => $img];
                    $this->db->where('type', 'bot_image')->update('tbl_settings', $frm_logo);
                } else {
                    $frm_logo = array(
                        'type' => 'bot_image',
                        'message' => $img
                    );
                    $this->db->insert('tbl_settings', $frm_logo);
                }
                return TRUE;
            }
        }

        $footer_copyrights_text = $this->input->post('footer_copyrights_text');
        $footer_text = $this->db->where('type', 'footer_copyrights_text')->get('tbl_settings')->row_array();
        if ($footer_text) {
            $footer_text_change = ['message' => $footer_copyrights_text];
            $this->db->where('type', 'footer_copyrights_text')->update('tbl_settings', $footer_text_change);
        } else {
            $footer_text_change = array(
                'type' => 'footer_copyrights_text',
                'message' => $footer_copyrights_text
            );
            $this->db->insert('tbl_settings', $footer_text_change);
        }

        $theme_color = $this->input->post('theme_color');
        $theme_color_db = $this->db->where('type', 'theme_color')->get('tbl_settings')->row_array();
        if ($theme_color_db) {
            $theme_color_change = ['message' => $theme_color];
            $this->db->where('type', 'theme_color')->update('tbl_settings', $theme_color_change);
        } else {
            $theme_color_change = array(
                'type' => 'theme_color',
                'message' => $theme_color
            );
            $this->db->insert('tbl_settings', $theme_color_change);
        }

        $navbar_color = $this->input->post('navbar_color');
        if($navbar_color){
            $navbar_color_db = $this->db->where('type', 'navbar_color')->get('tbl_settings')->row_array();
            if ($navbar_color_db) {
                $navbar_color_change = ['message' => $navbar_color];
                $this->db->where('type', 'navbar_color')->update('tbl_settings', $navbar_color_change);
            } else {
                $navbar_color_change = array(
                    'type' => 'navbar_color',
                    'message' => $navbar_color
                );
                $this->db->insert('tbl_settings', $navbar_color_change);
            }
        }

        $navbar_text_color = $this->input->post('navbar_text_color');
        if($navbar_text_color){
            $navbar_text_color_db = $this->db->where('type', 'navbar_text_color')->get('tbl_settings')->row_array();
            if ($navbar_text_color_db) {
                $navbar_text_color_change = ['message' => $navbar_text_color];
                $this->db->where('type', 'navbar_text_color')->update('tbl_settings', $navbar_text_color_change);
            } else {
                $navbar_text_color_change = array(
                    'type' => 'navbar_text_color',
                    'message' => $navbar_text_color
                );
                $this->db->insert('tbl_settings', $navbar_text_color_change);
            }
        }

        return TRUE;
    }

    public function delete_multiple($ids, $is_image, $table) {
        if ($is_image) {
            $path = array(
                'tbl_category' => CATEGORY_IMG_PATH,
                'tbl_subcategory' => SUBCATEGORY_IMG_PATH,
                'tbl_question' => QUESTION_IMG_PATH,
                'tbl_notifications' => NOTIFICATION_IMG_PATH,
                'tbl_contest' => CONTEST_IMG_PATH,
                'tbl_contest_question' => CONTEST_QUESTION_IMG_PATH,
                'tbl_audio_question' => QUESTION_AUDIO_PATH,
                'tbl_exam_module_question' => EXAM_QUESTION_IMG_PATH,
                'tbl_maths_question' => MATHS_QUESTION_IMG_PATH,
                'tbl_slider' => SLIDER_IMG_PATH,
                'tbl_coin_store' => COIN_STORE_IMG_PATH
            );
            if ($table == 'tbl_audio_question') {
                $query = $this->db->query("SELECT `audio` FROM " . $table . " WHERE id in ( " . $ids . " )");
                $res = $query->result();
                foreach ($res as $audio) {
                    if (!empty($audio->audio) && file_exists($path[$table] . $audio->audio)) {
                        unlink($path[$table] . $audio->audio);
                    }
                }
            } else {
                $query = $this->db->query("SELECT `image` FROM " . $table . " WHERE id in ( " . $ids . " )");
                $res = $query->result();
                foreach ($res as $image) {
                    if (!empty($image->image) && file_exists($path[$table] . $image->image)) {
                        unlink($path[$table] . $image->image);
                    }
                }
            }
        }
        $delete = $this->db->query("DELETE FROM `" . $table . "` WHERE `id` in ( " . $ids . " ) ");
        return $delete ? 1 : 0;
    }   

    public function update_contact_us() {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'contact_us')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'contact_us')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'contact_us',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_terms_conditions() {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'terms_conditions')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'terms_conditions')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'terms_conditions',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_privacy_policy() {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'privacy_policy')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'privacy_policy')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'privacy_policy',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_instructions() {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'instructions')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'instructions')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'instructions',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_about_us() {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'about_us')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'about_us')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'about_us',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_fcm_key() {
        $message = $this->input->post('message');
        $data = $this->db->where('type', 'fcm_server_key')->get('tbl_settings')->row_array();
        if ($data) {
            $frm_data = ['message' => $message];
            $this->db->where('type', 'fcm_server_key')->update('tbl_settings', $frm_data);
        } else {
            $frm_data = array(
                'type' => 'fcm_server_key',
                'message' => $message
            );
            $this->db->insert('tbl_settings', $frm_data);
        }
    }

    public function update_web_settings(){
        if (!is_dir(WEB_SETTINGS_LOGO_PATH)) {
            mkdir(WEB_SETTINGS_LOGO_PATH, 0777, TRUE);
        }
        $settings = [
            // 'data_ad_client','data_ad_slot',
            'firebase_api_key','firebase_auth_domain','firebase_database_url','firebase_project_id','firebase_storage_bucket','firebase_messager_sender_id','firebase_app_id','firebase_measurement_id',
            'meta_description','meta_keywords',
            'rtl_support',
            'company_name_footer','email_footer','phone_number_footer','web_link_footer','facebook_link_footer','instagram_link_footer','linkedin_link_footer','youtube_link_footer','company_text','address_text',
            'favicon','header_logo','footer_logo','sticky_header_logo',
            'quiz_zone_icon','daily_quiz_icon','true_false_icon','fun_learn_icon','self_challange_icon','contest_play_icon','one_one_battle_icon','group_battle_icon','audio_question_icon','math_mania_icon','exam_icon','guess_the_word_icon',
            'toggle_web_home_settings',
        ];
    
        foreach ($settings as $type) {
            $message = $this->input->post($type);
            $res = $this->db->where('type', $type)->get('tbl_web_settings')->row_array();
            if ($res) {
                // declaring the variable for skipping the itration
                $skip_update = false;
                //if file uploaded
                if (isset($_FILES[$type]) && !empty($_FILES[$type]['name'])){
                    $config['upload_path'] = WEB_SETTINGS_LOGO_PATH;
                    $config['allowed_types'] = WEB_SETTINGS_LOGO_IMG_ALLOWED_TYPES;
                    $config['file_name'] = $type.'-'.time();
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($type)) {
                        return FALSE;
                    }else{
                        // deletes old file
                        if (isset($res['message']) && $res['message'] != '') {
                            $old_file_path = WEB_SETTINGS_LOGO_PATH . $res['message'];
                            if (file_exists($old_file_path)) {
                                unlink($old_file_path);
                            }
                        }
                        $data = $this->upload->data();
                        $message = $data['file_name'];
                    }
                }else{
                    // array of all logos
                    $logos = ['favicon','header_logo','footer_logo','sticky_header_logo','quiz_zone_icon','daily_quiz_icon','true_false_icon','fun_learn_icon','self_challange_icon','contest_play_icon','one_one_battle_icon','group_battle_icon','audio_question_icon','math_mania_icon','exam_icon','guess_the_word_icon'];
                    // checks wheather type of loop is match with value of logos array
                    foreach ($logos as $value) {
                        if($type == $value){
                            // make skip_update variable true to skip the iteration
                            $skip_update = true;
                            break;
                        }
                    }
                    //if the skip_update variable true skip the foreach iteration and stops the value to be updated in database
                    if($skip_update){
                        continue;
                    }
                }
                $data = ['message' => $message];
                $this->db->where('type', $type)->update('tbl_web_settings', $data);
            } else {
                if (isset($_FILES[$type]) && $_FILES[$type]['name'] != ''){
                    $config['upload_path'] = WEB_SETTINGS_LOGO_PATH;
                    $config['allowed_types'] = WEB_SETTINGS_LOGO_IMG_ALLOWED_TYPES;
                    $config['file_name'] = $type.'-'.time();
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($type)) {
                        return FALSE;
                    }else{
                        $data = $this->upload->data();
                        $message = $data['file_name'];
                    }
                }
                $data = ['message' => $message, 'type' => $type];
                $this->db->insert('tbl_web_settings', $data);
            }
        }
    }


    public function update_web_home_settings(){
        if (!is_dir(WEB_HOME_SETTINGS_LOGO_PATH)) {
            mkdir(WEB_HOME_SETTINGS_LOGO_PATH, 0777, TRUE);
        }
        $settings = [
            'section1_heading','section1_title1','section1_title2','section1_title3','section1_image1','section1_image2','section1_image3','section1_desc1','section1_desc2','section1_desc3',
            'section2_heading','section2_title1','section2_title2','section2_title3','section2_title4','section2_desc1','section2_desc2','section2_desc3','section2_desc4','section2_image1','section2_image2','section2_image3','section2_image4',
            'section3_heading','section3_title1','section3_title2','section3_title3','section3_title4','section3_image1','section3_image2','section3_image3','section3_image4','section3_desc1','section3_desc2','section3_desc3','section3_desc4'
        ];
    
        foreach ($settings as $type) {
            $message = $this->input->post($type);
            $res = $this->db->where('type', $type)->get('tbl_web_settings')->row_array();
            if ($res) {
                // declaring the variable for skipping the itration
                $skip_update = false;
                //if file uploaded
                if (isset($_FILES[$type]) && !empty($_FILES[$type]['name'])){
                    $config['upload_path'] = WEB_HOME_SETTINGS_LOGO_PATH;
                    $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
                    $config['file_name'] = $type.'-'.time();
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($type)) {
                        return FALSE;
                    }else{
                        // deletes old file
                        if (isset($res['message']) && $res['message'] != '') {
                            $old_file_path = WEB_HOME_SETTINGS_LOGO_PATH . $res['message'];
                            if (file_exists($old_file_path)) {
                                unlink($old_file_path);
                            }
                        }
                        $data = $this->upload->data();
                        $message = $data['file_name'];
                    }
                }else{
                    // array of all images
                    $images = ['section1_image1','section1_image2','section1_image3','section2_image1','section2_image2','section2_image3','section2_image4','section3_image1','section3_image2','section3_image3','section3_image4'];
                    // checks wheather type of loop is match with value of images array
                    foreach ($images as $value) {
                        if($type == $value){
                            // make skip_update variable true to skip the iteration
                            $skip_update = true;
                            break;
                        }
                    }
                    //if the skip_update variable true skip the foreach iteration and stops the value to be updated in database
                    if($skip_update){
                        continue;
                    }
                }
                $data = ['message' => $message];
                $this->db->where('type', $type)->update('tbl_web_settings', $data);
            } else {
                if (isset($_FILES[$type]) && !empty($_FILES[$type]['name'])){
                    $config['upload_path'] = WEB_HOME_SETTINGS_LOGO_PATH;
                    $config['allowed_types'] = IMG_ALLOWED_WITH_SVG_TYPES;
                    $config['file_name'] = $type.'-'.time();
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($type)) {
                        return FALSE;
                    }else{
                        $data = $this->upload->data();
                        $message = $data['file_name'];
                    }
                }
                $data = ['message' => $message, 'type' => $type];
                $this->db->insert('tbl_web_settings', $data);
            }
        }
    }

}
