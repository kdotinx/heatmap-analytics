<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fupload
 *
 * @author ADMIN
 */
class FUpload {

    /**
     * Upload a file  
     * @param $pathToSave where to save file by default the value is upload
     * @param $overwrite by default is set to FALSE 
     * @param $create_dir by default is set to FALSE, Creates directry if made to yes
     * @param $filed_name name of the input field from html,  by default the value is file
     * @param $extensions by default the value is array("jpeg", "jpg", "png")
     * @param $size by default the value is 2 MB can change
     * @return array [0 => status][1=>filepath]
     */
    function uploadFile($pathToSave = "upload", $overwrite = FALSE, $create_dir = FALSE, $filed_name = "file", $extensions = array("jpeg", "jpg", "png", "ico", "JPG"), $size = 2097152) {
        $result = array();
        if (isset($_FILES["$filed_name"])) {
            $file_name = str_replace("", "_", $_FILES[$filed_name]['name']);
            $file_size = $_FILES[$filed_name]['size'];
            $file_tmp = $_FILES[$filed_name]['tmp_name'];
            $file_type = $_FILES[$filed_name]['type'];
            if (isset($file_tmp)) {
                // OBTAIN PATH
                $file_path = str_replace("controller", $pathToSave, getcwd()) . "/";

                //check for extensions
                $file_exn = array_reverse(explode('.', $file_name))[0];
                if (isset($file_exn) && (in_array($file_exn, $extensions) === false)) {
                    array_push($result, "error", "extension not allowed,  ( please choose " . implode(", ", $extensions));
                }
                //create dir
                 if ($create_dir) { 
                    if (!file_exists($file_path)) {
                        mkdir($file_path, 0777, true);
                    }
                }
                // check for the file exists
                if (file_exists($file_path . "/" . $file_name)) {
                    if (!$overwrite) {
                        $file_path.= date("smhddMy") . $file_name;
                    } else {
                         $file_path.= $file_name;
                    }
                } else {
                    $file_path.= $file_name;
                    
                }

               

                if (empty($result) == true) {
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        array_push($result, "success");
                        array_push($result, str_replace("\\", "/", $file_path));
                    }
                }
            } else {
                array_push($result, "error", "File size must be less than 2 MB");
            }
        }
        return $result;
    }

}
