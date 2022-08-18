<?php

    class JsonStudent {
        // save student name to file in JSON
        static function save_student($file, $name) {
            if (file_exists($file) && file_get_contents($file) !== "") {
                $file_content = json_decode(file_get_contents($file), true);
                array_push($file_content, ["name" => $name]);
                $to_put = $file_content;
            } else {
                $to_put = [["name" => $name]];
            }
            file_put_contents($file, json_encode($to_put, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT));
        }

        // display all students from file
        static function display_students($file) {
            $file_content = file_get_contents($file);
            $file_content = json_decode($file_content, true);
            print_r($file_content);
        }
    }