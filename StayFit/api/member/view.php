<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Member.php';

    if(!isset($_SERVER ['PHP_AUTH_USER'])) {
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry, you need proper credentials";
        exit;
    }else{
        if(($_SERVER['PHP_AUTH_USER'] == 'Admin' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            //Access granted to admins
        } 
        elseif(($_SERVER['PHP_AUTH_USER'] == 'Staff' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))) {
            //Access granted to staff
        } 
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
    $member = new Member($db);


    if(isset($_GET['Member_ID'])){
        //Get Member_ID
        $member->Member_ID = $_GET['Member_ID'];
        //Get Equipment Bookings
        $result = $member->select();
        $num = $result->rowCount();
        
        if($num > 0){
            $member_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $member_arr[$row['Member_ID']] = array(
                    'Client_ID' => $row['Client_ID'],
                    'Member_ID' => $row['Member_ID']
                );
            }
            //Turn to JSON & output
            echo json_encode($member_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }
    else{
        $result = $member->view();
        $num = $result->rowCount();
        if($num > 0){
            $member_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $member_arr[$row['Member_ID']] = array(
                    'Client_ID' => $row['Client_ID'],
                    'Member_ID' => $row['Member_ID']
                );
            }
            //Turn to JSON & output
            echo json_encode($member_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }
    
?>
