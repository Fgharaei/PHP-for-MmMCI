<?php
//اتصال به سرور
$DbHost = "localhost";
$DbUser = "gharaei";
$Password = "13551219";
$DbName = "mmmdb";


$conection = new mysqli($DbHost, $DbUser, $Password, $DbName);

$json = file_get_contents('php://input');
$userInfo = json_decode($json);
// var_dump($userInfo);
$name = $userInfo->{'user'};
$password = $userInfo->{'pass'};


if ($conection->connect_error) {
    die("failed: " . $conection->connect_error);
}

//if (!empty($_POST["user"]) && !empty($_POST["pass"])) {
if (!empty($name) && !empty($password)) {

    //    $name = $_POST["user"];
    //    $password = $_POST["pass"];
    ////$name="f.gharaei";
    //$password="123456";


    $sql = "SELECT * FROM registertable WHERE Username='$name' AND Password='$password' ";

    $result = $conection->query($sql);
    //$row = $result->fetch_assoc();
    $row = $result->fetch_assoc();


    if ($result->num_rows > 0) {
    //if (COUNT($row)>0) {

        echo JSON_encode($row);
    //    echo "OK";

    } else {

        $rowerror["error"] = "Not Register";
        echo JSON_encode($rowerror);
//    echo JSON_encode($row);

    }


    $conection->close();

} else {

    $rowerror["error"] = "No data";
    echo JSON_encode($rowerror);

}


?>