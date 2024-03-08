<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class System_Update extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set(get_system_timezone());

        $this->load->helper('password_helper');
        $this->result['full_logo'] = $this->db->where('type', 'full_logo')->get('tbl_settings')->row_array();
        $this->result['half_logo'] = $this->db->where('type', 'half_logo')->get('tbl_settings')->row_array();
        $this->result['app_name'] = $this->db->where('type', 'app_name')->get('tbl_settings')->row_array();
        $this->result['system_key'] = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        $this->result['configuration_key'] = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
    }

    public function set_setting() {
        $purchase_code = $this->input->post('purchase_code');
        $purchase_code = getHashedPassword($purchase_code);
        $system_key = $this->db->where('type', 'system_key')->get('tbl_settings')->row_array();
        if ($system_key) {
            $frm_system_key = ['message' => $purchase_code];
            $this->db->where('type', 'system_key')->update('tbl_settings', $frm_system_key);
        } else {
            $frm_system_key = array(
                'type' => 'system_key',
                'message' => $purchase_code
            );
            $this->db->insert('tbl_settings', $frm_system_key);
        }
        $quiz_url = $this->input->post('quiz_url');
        $quiz_url = getHashedPassword($quiz_url);
        $configuration_key = $this->db->where('type', 'configuration_key')->get('tbl_settings')->row_array();
        if ($configuration_key) {
            $frm_config_key = ['message' => $quiz_url];
            $this->db->where('type', 'configuration_key')->update('tbl_settings', $frm_config_key);
        } else {
            $frm_config_key = array(
                'type' => 'configuration_key',
                'message' => $quiz_url
            );
            $this->db->insert('tbl_settings', $frm_config_key);
        }
        redirect('/');
    }

    public function index() {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        } else {
            if (!$this->session->userdata('authStatus')) {
                redirect('/');
            } else {
                if ($this->input->post('btnadd')) {
                    if (!has_permissions('create', 'set_setting')) {
                        $this->session->set_flashdata('error', PERMISSION_ERROR_MSG);
                    } else {
                        if ($_FILES['file']['name'] != '') {
                            $purchase_code = $this->input->post('purchase_code');
                            $quiz_url = $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://wrteam.in/validator/flutter_quiz_validator?purchase_code=' . $purchase_code . '&domain_url=' . $quiz_url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'GET',
                            ));
                            $response = curl_exec($curl);
                            $response = json_decode($response, 1);
                            curl_close($curl);
                            if ($response["error"] == false) {
                                $tmp_path = 'images/tmp';
                                if (!is_dir($tmp_path)) {
                                    mkdir($tmp_path, 0777, TRUE);
                                }
                                $target_path = getcwd() . DIRECTORY_SEPARATOR;

                                $config['upload_path'] = $tmp_path;
                                $config['allowed_types'] = 'zip|rar';
                                $config['file_name'] = $_FILES['file']['name'];
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);

                                if ($this->upload->do_upload('file')) {
                                    $uploadData = $this->upload->data();
                                    $fileName = $uploadData['file_name'];

                                    $zip = new ZipArchive();
                                    $filePath = $tmp_path . '/' . $fileName;
                                    $zipFile = $zip->open($filePath);
                                    if ($zipFile === true) {
                                        $zip->extractTo($tmp_path);
                                        $zip->close();
                                        unlink($filePath);

                                        $ver_file1 = $tmp_path . '/version_info.php';
                                        $source_path1 = $tmp_path . '/source_code.zip';
                                        $sql_file1 = $tmp_path . '/database.sql';
                                        if (file_exists($ver_file1) && file_exists($source_path1) && file_exists($sql_file1)) {
                                            $ver_file = $target_path . 'version_info.php';
                                            $source_path = $target_path . 'source_code.zip';
                                            $sql_file = $target_path . 'database.sql';

                                            if (rename($ver_file1, $ver_file) && rename($source_path1, $source_path) && rename($sql_file1, $sql_file)) {
                                                $version_file = require_once ($ver_file);
                                                $res = $this->db->where('type', 'system_version')->get('tbl_settings')->row_array();
                                                $current_version = (!empty($res)) ? $res['message'] : '';
                                                if ($current_version == $version_file['current_version']) {
                                                    $zip1 = new ZipArchive();
                                                    $zipFile1 = $zip1->open($source_path);

                                                    if ($zipFile1 === true) {
                                                        $zip1->extractTo($target_path); // change this to the correct site path
                                                        $zip1->close();
                                                        if (file_exists($sql_file)) {
                                                            $lines = file($sql_file);
                                                            for ($i = 0; $i < count($lines); $i++) {
                                                                if (!empty($lines[$i])) {
                                                                    $this->db->query($lines[$i]);
                                                                }
                                                            }
                                                        }
                                                        unlink($source_path);
                                                        unlink($ver_file);
                                                        unlink($sql_file);
                                                        $frm_data = ['message' => $version_file['update_version']];
                                                        $this->db->where('type', 'system_version')->update('tbl_settings', $frm_data);
                                                        $this->session->set_flashdata('success', 'System update successfully.!');
                                                        redirect('system-updates', 'refresh');
                                                    } else {
                                                        unlink($source_path);
                                                        unlink($ver_file);
                                                        unlink($sql_file);
                                                        $this->session->set_flashdata('error', 'Something wrong, please try again.!');
                                                        redirect('system-updates', 'refresh');
                                                    }
                                                } else if ($current_version == $version_file['update_version']) {
                                                    unlink($source_path);
                                                    unlink($ver_file);
                                                    unlink($sql_file);
                                                    $this->session->set_flashdata('error', 'System is already updated.!');
                                                    redirect('system-updates', 'refresh');
                                                } else {
                                                    unlink($source_path);
                                                    unlink($ver_file);
                                                    unlink($sql_file);
                                                    $this->session->set_flashdata('error', 'Your version is ' . $current_version . '. Please update nearest version first');
                                                    redirect('system-updates', 'refresh');
                                                }
                                            } else {
                                                $this->DeleteDir($tmp_path);
                                                $this->session->set_flashdata('error', 'Invalid file, please try again.!');
                                                redirect('system-updates', 'refresh');
                                            }
                                        } else {
                                            $this->DeleteDir($tmp_path);
                                            $this->session->set_flashdata('error', 'Invalid file, please try again.!');
                                            redirect('system-updates', 'refresh');
                                        }
                                    } else {
                                        $this->DeleteDir($tmp_path);
                                        $this->session->set_flashdata('error', 'Something wrong, please try again.!');
                                        redirect('system-updates', 'refresh');
                                    }
                                } else {
                                    $this->session->set_flashdata('error', 'Only zip allow, please try again.!');
                                    redirect('system-updates', 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error', $response["message"]);
                                redirect('system-updates', 'refresh');
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Please Upload zip file.!');
                            redirect('system-updates', 'refresh');
                        }
                    }
                    redirect('system-updates', 'refresh');
                }
                $this->result['system_version'] = $this->db->where('type', 'system_version')->get('tbl_settings')->row_array();
                $this->load->view('system_updates', $this->result);
            }
        }
    }

    public function DeleteDir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        $dir_sec = $dir . "/" . $object;
                        if (is_dir($dir_sec)) {
                            foreach ($dir_sec as $sec) {
                                if ($sec != "." && $sec != "..") {
                                    if (filetype($dir . "/" . $dir_sec . "/" . $sec) == "dir") {
                                        $dir_sec1 = $dir . "/" . $dir_sec . "/" . $sec;
                                        if (is_dir($dir_sec1)) {
                                            rmdir($dir_sec1);
                                        }
                                    } else {
                                        unlink($dir . "/" . $dir_sec . "/" . $sec);
                                    }
                                }
                            }
                            rmdir($dir_sec);
                        }
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

}

?>
