<?php
    date_default_timezone_set("Europe/Bratislava");
    $current_date = date("F j, Y, H:i");

    // save arrival to file
    function save_arrival($file, $current_date, $name, $delay) {
        $to_put = "$name: $current_date $delay";
        if (file_exists($file) && file_get_contents($file) !== "") {
            $file_text = file_get_contents($file);
            $to_put = "$file_text \n" . "$name: $current_date $delay";
        } 
        file_put_contents($file, $to_put);
    };

    // get delay from current date
    function get_delay($hours) {
        if ($hours >= 20) {
        } else if ($hours >= 8) {
            return "meškanie";
        }
        return "";
    };

    // get arrivals from file and display them
    function display_arrivals($file) {
        $file_text = file_get_contents($file);
        $file_text = explode("\n", $file_text);
        foreach ($file_text as $arrival) {
            echo "$arrival <br>";
        }
    };