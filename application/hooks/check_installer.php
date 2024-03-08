<?php

class Check_installer {

    function check_for_installer() {
        if (file_exists('install/index.php')) {
            header("location:install/");
            die();
        }
    }

}
