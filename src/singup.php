<?php

    //get data base connection 
     require('../config/database.php');
    //get data from html form obtener datos del cliente 

    $f_name =   $_POST['fname'];
    $l_name =   $_POST['lname'];
    $m_phone =  $_POST['mphone'];
    $e_email =  $_POST['email'];
    $p_assword = $_POST['pswd'];
    $pass_enc   =md5($p_assword); ///encriptar la contraseña o tapar la contraseña 
    $photo     ='photos/user_default.png';

    //validar que el usuario no este registrado 
    //sql de validate
    $sql_validation ="
        select 
            u.email
        from 
            users u
        where
            u.email ='$e_email'
    "; 

   // $local_res= pg_query($local_conn,$sql_validation);
    $supa_res= pg_query($supa_conn,$sql_validation);

    $total = pg_fetch_result($supa_res, 0, 0);
     if($total > 0 ){
        echo "<script>alert('User email alredy exists :::')</script> ";
        header('refresh:0;url=singin.html');
     }else{
         $sql = "
        INSERT INTO users (
            firstname,
            lastname,
            mobile_phone,
            email,
            password
            photo_url
        )
        VALUES (
            '$f_name',
            '$l_name',
            '$m_phone',
            '$e_email',
            '$pass_enc'
            '$photo'
        )
    ";
    //$local_res= pg_query($local_conn,$sql);
    $supa_res= pg_query($supa_conn,$sql);

    //if ($local_res){
    //    echo "<br>User has bean created succesfully into local database!!";
    //}
    //else
    //    echo"<br>User hasn't been created into local database!!";

     if($supa_res){
        echo "<br>User has been created successfully into supabase database !!!";}
        else{
            echo "<br>User hasn't been created into supabase database !!!";}

     //redireccionar a la pagina de inicio de sesion
            echo"<script>alert('User has been created successfully!!!');</script>";
    //redireccionar a la pagina de inicio de sesion
            header('refresh: 0; url=singin.html');
    }

?>                                                                                                                                                                             
