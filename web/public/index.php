<?php

    require_once "names_list.php";
    require_once "surnames_list.php";
    require_once "country_list.php";

    global $names_list,$surnames_list, $country_list;

    $db = mysqli_connect("mysql","dev","dev","test","3306");

    if (isset($_GET["add_records"])) {
        echo "Adding " . $_GET["add_records"] . " uniq clients";

        for ($i = 0; $i < $_GET["add_records"]; $i++) {

            $name = $names_list[array_rand($names_list)]." ".$surnames_list[array_rand($surnames_list)];
            $country = $country_list[array_rand($country_list)];
            $last_login = rand(946684800,time()); // 2000 to now

            mysqli_query($db,"INSERT INTO `Clients` (`name`,`country`,`last_login`) VALUES ('$name','$country',$last_login)");

        }


        exit;
    }

    if (isset($_GET["login_from"])) {
        $res = mysqli_query($db, "SELECT count(1) as `connections` FROM `Clients` WHERE `last_login` > ".$_GET["login_from"]);
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_assoc($res);
            echo $row["connections"]." clients logged in since ".date("d-m-Y H:i:s",$_GET["login_from"]);
        } else {
            echo "0 clients logged in since ".date("d-m-Y H:i:s",$_GET["login_from"]);
        }
        exit;
    }

    if (isset($_GET["random_name_count"])) {
        $name = rand(1,2) === 1? $names_list[array_rand($names_list)] : $surnames_list[array_rand($surnames_list)];
        $res = mysqli_query($db, "SELECT count(1) as `connections` FROM `Clients` WHERE `name` LIKE '%$name%'");
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_assoc($res);
            echo $row["connections"]." clients with name $name";
        } else {
            echo "0 clients with name $name";
        }
        exit;
    }

if (isset($_GET["random_country_count"])) {
    $country = $country_list[array_rand($country_list)];
    $res = mysqli_query($db, "SELECT count(1) as `connections` FROM `Clients` WHERE `country` = '$country'");
    if (mysqli_num_rows($res)) {
        $row = mysqli_fetch_assoc($res);
        echo $row["connections"]." clients from $country";
    } else {
        echo "0 clients from $country";
    }
    exit;
}

