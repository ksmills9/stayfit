<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/bookablelocation.php';

    if(!isset($_SERVER ['PHP_AUTH_USER'])){
      header ("WWW-Authenticate: Basic realm=\"Private Area\"");
      header ("HTTP/1.0 401 Unauthorised");
      print "Sorry, you need proper credentials";
      exit;
    }else{
      if(($_SERVER['PHP_AUTH_USER'] == 'Admin' && ($_SERVER['PHP_AUTH_PW'] == 'password123'))){
        print "You are in the private area";
      }
      else{
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
      header ("HTTP/1.0 401 Unauthorised");
      print "Sorry, you need proper credentials.";
      exit;
      }
    }



    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate equipment purchase object
    $bookable_loc = new bookablelocation($db);

    $result = $bookable_loc->view();
    $num = $result->rowCount();

    //Check for bookings
    if($num > 0){
        $bookable_loc_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $bookable_loc_arr[$row['Space_ID']] = array(
                'Space_name' => $row['Space_name'],
                'Location' => $row['Location'],
                'Capacity' => $row['Capacity'],
                'Open_time' => $row['Open_time'],
                'Close_time' => $row['Close_time'],
                'Price' => $row['Price']

            );
        }
        //Turn to JSON & output
        echo json_encode($bookable_loc_arr);
    }
    else{
        //No Data
        echo json_encode (
            array('message' => 'No Data')
        );
    }
