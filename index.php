<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Log</title>
</head>
<body>
    <div class="background">
        <div class="first"></div>
        <div class="second"></div>
    </div>
    <div class="wrap">
        <form action="index.php" method="post">
            <input type="text" name="name" id="name" class="name" placeholder="Name">
            <input type="submit" class="send" value="Send">
        </form>

        <div class="students">
            <?php 
                include "php-saves/json-students-save.php";
                JsonStudent::display_students("saved-files/students.json");
            ?>
        </div>
    </div>

    <?php
        if ($_GET["name"]) {
            $name = $_GET["name"];
        } else if ($_POST["name"]) {
            $name = $_POST["name"];
        } else {
            die("Enter name");
        }
        include "php-saves/txt-save.php";
        include "php-saves/json-arrivals-save.php";
        save_arrival("saved-files/students.txt", $current_date, $name, get_delay(date("H")));
        
        JsonStudent::save_student("saved-files/students.json", $name);
        $json_arrival->save_arrival($current_date);
        $json_arrival->iterate_arrivals();
    ?>
</body>
</html>