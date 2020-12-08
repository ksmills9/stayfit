<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Staff.php';

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
    $staff = new Staff($db);

    //Check for staff

    if(isset($_GET['Staff_ID'])){
        //Get Staff_ID
        $staff->Staff_ID = $_GET['Staff_ID'];
        //Get Equipment Bookings
        $result = $staff->select();
        $num = $result->rowCount();
        
        //Check for bookings
        if($num > 0){
            $staff_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $staff_arr[$row['Staff_ID']] = array(
                    'Staff_ID' => $row['Staff_ID'],
                    'FirstName' => $row['FirstName'],
                    'LastName' => $row['LastName'],
                    'JobTitle' => $row['JobTitle']
                );
            }
            //Turn to JSON & output
            echo json_encode($staff_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }
    else{
        $result = $staff->view();
        $num = $result->rowCount();
        if($num > 0){
            $staff_arr = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $staff_arr[$row['Staff_ID']] = array(
                    'Staff_ID' => $row['Staff_ID'],
                    'FirstName' => $row['FirstName'],
                    'LastName' => $row['LastName'],
                    'JobTitle' => $row['JobTitle']
                );
            }
            //Turn to JSON & output
            echo json_encode($staff_arr);
        }
        else{
            //No Data
            echo json_encode (
                array('message' => 'No Data')
            );
        }
    }
    
?>
