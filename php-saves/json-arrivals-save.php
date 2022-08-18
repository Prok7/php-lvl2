<?php
    class JsonArrival {
        function __construct($file) {
            $this->file = $file;
        }

        // save arrival to json array in file
        function save_arrival($arrival) {
            if (file_exists($this->file) && file_get_contents($this->file) !== "") {
                $file_content = json_decode(file_get_contents($this->file));
                array_push($file_content, $arrival);
                $to_put = $file_content;
            } else {
                $to_put = [$arrival];
            }
            file_put_contents($this->file, json_encode($to_put, JSON_PRETTY_PRINT));
        }

        // find which hours are delayed in arrivals
        private function find_delay($arrivals) {
            $new_arr = [];
            foreach ($arrivals as $arrival) {
                if (!strpos($arrival, "meskanie")) {
                    $splitted_arrival = explode(",", $arrival);
                    $time = $splitted_arrival[2];
                    $hours = explode(":", $time)[0];
                    if ($hours >= 8) {
                        $arrival = "$arrival meskanie";
                    }
                }
                array_push($new_arr, $arrival);
            }
            return $new_arr;
        }

        // iterate through arrivals in file and write delay to them
        function iterate_arrivals() {
            $arrivals = file_get_contents($this->file);
            $arrivals = json_decode($arrivals);
            $new_arr = $this->find_delay($arrivals);
            file_put_contents($this->file, json_encode($new_arr, JSON_PRETTY_PRINT));
        }
    };
    $json_arrival = new JsonArrival("saved-files/arrivals.json");