<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Admin.php';

    if(!isset($_SERVER ['PHP_AUTH_USER'])) {
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry, you need proper credentials";
        exit;
    }else{
        if(($_SERVER['PHP_AUTH_USER'] == 'Admin' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            //Access granted to admins
        } /*
        elseif(($_SERVER['PHP_AUTH_USER'] == 'Staff' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            //Access granted to staff
        } */
        else {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            print "Sorry, you need proper credentials";
            exit;
        }
    }
    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment booking object
    $admin = new Admin($db);

    //Check for admin
    $result = $admin->view_request();
    $num = $result->rowCount();
    if($num > 0){
        $admin_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $admin_arr[$row['Admin_ID']] = array(
                'Admin_ID' => $row['Admin_ID'],
                'Staff_ID' => $row['Staff_ID'],
                'Request_ID' => $row['Request_ID'],
                'description' => $row['description'],
                'request_time' => $row['request_time']
            );
        }
        //Turn to JSON & output
        echo json_encode($admin_arr);
    }
    else{
        //No Data
        echo json_encode (
            array('message' => 'No Data')
        );
    }
    
    
?>
