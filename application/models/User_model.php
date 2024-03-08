<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_data() {
        return $this->db->order_by('id', 'DESC')->get('tbl_users')->result();
    }

    public function get_user_rights($id) {
        return $this->db->select('permissions')->where('auth_id', $id)->get('tbl_authenticate')->result_array();
    }

    public function update_user() {
        $id = $this->input->post('edit_id');
        $data = array(
            'status' => $this->input->post('status')
        );
        $this->db->where('id', $id)->update('tbl_users', $data);
    }




    public function update_user_coin(){




        $fcm_id= $this->db->select('firebase_id,coins')->where('id', $this->input->post('user_id_coin'))->get('tbl_users')->result();
     
        $coins=$fcm_id[0]->coins + $this->input->post('coins');

        $data=array(
            'coins'=>$coins,

        );

        $this->db->where('id', $this->input->post('user_id_coin'))->update('tbl_users', $data);
        
    
        $frm_data = array(
            'user_id' => $this->input->post('user_id_coin'),
            'uid' =>  $fcm_id[0]->firebase_id,
            'points' => $this->input->post('coins'),
            'type' => 'adminAdded',
            'status' => 0,
            'date' => date('Y-m-d')
        );
        $this->db->insert('tbl_tracker', $frm_data);
     
    }


    public function add_user_rights() {
        $password = getHashedPassword($this->input->post('password'));
        $data = $this->input->post();
        $permission_data = json_encode($data['permissions']);

        $frm_data = array(
            'auth_username' => $this->input->post('username'),
            'auth_pass' => $password,
            'role' => $this->input->post('role'),
            'permissions' => $permission_data,
            'status' => 0,
            'created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tbl_authenticate', $frm_data);
    }

    public function update_user_rights() {
        $id = $this->input->post('edit_id');

        $password = getHashedPassword($this->input->post('password'));
        $data = $this->input->post();
        $permission_data = json_encode($data['permissions']);

        $frm_data = array(
            'auth_username' => $this->input->post('username'),
            'role' => $this->input->post('role'),
            'permissions' => $permission_data,
        );
        if ($this->input->post('password')) {
            $frm_data['auth_pass'] = $password;
        }

        $this->db->where('auth_id', $id)->update('tbl_authenticate', $frm_data);
    }

    public function delete_user_rights($id) {
        $this->db->where('auth_id', $id)->delete('tbl_authenticate');
    }

    public function general_statistics($user_id) {
        $query = $this->db->query("SELECT us.*,u.name,u.profile,(SELECT category_name FROM tbl_category c WHERE c.id=us.strong_category) as strong_category, (SELECT category_name FROM tbl_category c WHERE c.id=us.weak_category) as weak_category FROM tbl_users_statistics us LEFT JOIN tbl_users u on u.id = us.user_id WHERE `user_id`=$user_id");
        return $res = $query->result();
    }

    public function battle_statistics($user_id) {
        $query = $this->db->query("SELECT (SELECT COUNT(`winner_id`) FROM tbl_battle_statistics WHERE winner_id= $user_id) AS Victories,(SELECT COUNT(*) FROM (SELECT DISTINCT `date_created` from tbl_battle_statistics WHERE (user_id1= $user_id || user_id2= $user_id)AND is_drawn=1)as d) AS Drawn,(SELECT COUNT(`winner_id`) FROM tbl_battle_statistics WHERE (user_id1= $user_id || user_id2= $user_id) AND winner_id != $user_id and is_drawn = 0 )AS Loose,(SELECT name FROM tbl_users WHERE id= $user_id) AS name");
        return $res = $query->result();
    }

}

?>