<?php
   
    //Configurar datos de acceso a la Base de datos
    $host = "localhost";
    $dbname = "agenda";
    $dbuser = "postgres";
    $userpass = "ajuan102030";
    
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$dbuser;password=$userpass";
    
    try{
     //Crear conexión a postgress
     $pdo = new PDO($dsn);
    
     //Mostgrar mensaje si la conexión es correcta
     if($pdo){
    //  echo "Conectado a la base $dbname correctamente!"; 
     echo "\n";
     }
    }catch (PDOException $e){
     //Si hay error en la conexión mostrarlo
     echo $e->getMessage();
    }

    
  /* $categoria = "Trabajo";

    $query_insert = "INSERT INTO agenda_s.categories (categories)  VALUES (?)";

    $stmt_insert = $pdo->prepare($query_insert);
    
    $stmt_insert->execute([$categoria]); */

    
 



