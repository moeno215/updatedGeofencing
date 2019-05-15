<?php 


   include "db.php";
$response = array();
        $vsusername = $_POST['edtusername'];
         $vspassword = md5($_POST['edtpassword']);
   
        #Query the database to get the user details.
        $con = mysqli_connect(HOST,USER,PASSWORD,DATABASE);

        $leveldetails = mysqli_query($con, "SELECT * FROM users WHERE edtusername= '$vsusername' and edtpassword ='$vspassword' "); 
        #If no data was returned, check for any SQL errors 
       
        if (!$leveldetails){
          echo 'Could not run query: ' . mysqli_error($con);
            exit;
        }

        #Get the first row of the results 
        $row = mysqli_fetch_row($leveldetails);
        #Build the result array (Assign keys to the values) 
        $result_data = array( 
            'id' => $row[0],
            'nama' => $row[1],
            'edtusername' => $row[2],
            'edtpassword'   => $row[3],
            'levl' => $row[4]

            ); 
	
        #Output the JSON data 
      if (mysqli_num_rows($leveldetails) > 0) {
      $response['result'] = "1";
      $response['msg'] = "Welcome";
      $response['user'] = $result_data;

  
    } else {
      $response['result'] = "0";
      $response['msg'] = "Gagal login!!";

    }

    echo json_encode($response);



?>