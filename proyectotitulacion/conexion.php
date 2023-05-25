<?php 
    function OpenCon(){
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db     = "tiendacomponentes";
        $dbport = 3306;
        $conn   = new mysqli($dbhost, $dbuser, $dbpass, $db, $dbport, 'AL32UTF8');

        if($conn->connect_errno){
            echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ". $mysqli->connect_errno;
        }
        // else{
        //     echo "conectado";
        // }
        
        return $conn;

        function CloseConn($conn){
            mysqli_close($conn);
        }
    }


    // $result = mysqli_query($conn, "SELECT * FROM ESTADO");
    // mysqli_data_Seek($result, 0);
    // $extraido=mysqli_fetch_array($result);
    // echo "EID: ".$extraido['edo_id']."<br>";
?>