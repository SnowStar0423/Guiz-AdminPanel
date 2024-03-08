<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Badges_model extends CI_Model {

    public function get_set_data($type, $data) {
        $res = $this->db->where('type', $type)->get('tbl_badges')->row_array();
        if ($res) {
            $this->db->where('type', $type)->update('tbl_badges', $data);
        } else {
            $this->db->insert('tbl_badges', $data);
        }
    }

    public function get_badges_image($type) {
        $res = $this->db->where('type', $type)->get('tbl_badges')->row_array();
        $image = ($res) ? $res['badge_icon'] : '';
        return $image;
    }

    public function upload_badges_image($type, $file) {
        $config['upload_path'] = BADGE_IMG_PATH;
        $config['allowed_types'] = IMG_ALLOWED_TYPES;
        $config['file_name'] = time();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($file)) {
            return FALSE;
        } else {
            $image_url = $this->get_badges_image($type);
            if (file_exists($image_url)) {
                unlink($image_url);
            }

            $data = $this->upload->data();
            $img = $data['file_name'];
            return $img;
        }
    }

    public function update_data() {

        if (!is_dir(BADGE_IMG_PATH)) {
            mkdir(BADGE_IMG_PATH, 0777, TRUE);
        }

        $badges = [
            'dashing_debut',
            'combat_winner',
            'clash_winner',
            'most_wanted_winner',
            'ultimate_player',
            'quiz_warrior',
            'super_sonic',
            'flashback',
            'brainiac',
            'big_thing',
            'elite',
            'thirsty',
            'power_elite',
            'sharing_caring',
            'streak'
        ];
        foreach ($badges as $type) {
            $file = $type . '_file';
            $label = $type . '_label';
            $note = $type . '_note';
            $reward = $type . '_reward';
            $counter = $type . '_counter';

            $frm_data = [
                'type' => $type,
                'badge_label' => $this->input->post($label),
                'badge_note' => $this->input->post($note),
                'badge_reward' => $this->input->post($reward),
                'badge_counter' => ($this->input->post($counter)) ? $this->input->post($counter) : 0
            ];

            if ($_FILES[$file]['name'] != '') {
                $img = $this->upload_badges_image($type, $file);
                if ($img) {
                    $frm_data['badge_icon'] = $img;
                    $this->get_set_data($type, $frm_data);
                } else {
                    return FALSE;
                }
            } else {
                $this->get_set_data($type, $frm_data);
            }
        }

        $title = $this->input->post('title');
        $body = $this->input->post('body');
        $data = array(
            ['type' => 'notification_title', 'message' => $title],
            ['type' => 'notification_body', 'message' => $body],
        );

        foreach ($data as $setting) {
            // Check if the type already exists
            $this->db->where('type', $setting['type']);
            $query = $this->db->get('tbl_settings');

            if ($query->num_rows() > 0) {
                // If the type exists, update the record
                $this->db->where('type', $setting['type']);
                $this->db->update('tbl_settings', array('message' => $setting['message']));
            } else {
                // If the type does not exist, insert a new record
                $this->db->insert('tbl_settings', array('type' => $setting['type'], 'message' => $setting['message']));
            }
        }


        return TRUE;
    }

}

?>