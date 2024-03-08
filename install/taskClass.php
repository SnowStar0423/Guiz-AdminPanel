<?php

class Core {

    function checkEmpty($data) {
        if (!empty($data['hostname']) && !empty($data['username']) && !empty($data['database']) && !empty($data['url']) && !empty($data['template'])) {
            return true;
        } else {
            return false;
        }
    }

    function show_message($type, $message) {
        return $message;
    }

    function getAllData($data) {
        return $data;
    }

    function write_config($data) {

        $template_path = 'includes/databaseName.php';

        $output_path = '../application/config/database.php';

        $database_file = file_get_contents($template_path);

        $new = str_replace("%HOSTNAME%", $data['hostname'], $database_file);
        $new = str_replace("%USERNAME%", $data['username'], $new);
        $new = str_replace("%PASSWORD%", $data['password'], $new);
        $new = str_replace("%DATABASE%", $data['database'], $new);

        $handle = fopen($output_path, 'w+');
        @chmod($output_path, 0777);

        if (is_writable($output_path)) {

            if (fwrite($handle, $new)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function checkFile() {
        $output_path = '../application/config/database.php';

        if (file_exists($output_path)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_directory($dir) {

        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {

                if ($object != "." && $object != "..") {

                    if (filetype($dir . "/" . $object) == "dir") {

                        // return 'this is folder';
                        $dir_sec = $dir . "/" . $object;
                        if (is_dir($dir_sec)) {
                            $objects_sec = scandir($dir_sec);
                            foreach ($objects_sec as $object_sec) {
                                if ($object_sec != "." && $object_sec != "..") {
                                    if (filetype($dir_sec . "/" . $object_sec) == "dir")
                                        rmdir($dir_sec . "/" . $object_sec);
                                    else
                                        unlink($dir_sec . "/" . $object_sec);
                                }
                            }
                            rmdir($dir_sec);
                        }
                    }else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            return rmdir($dir);
        }
    }

}
