<?php

function insertEmploye($LastName, $FirstName, $Email, $Diner, $Postcode, $Locomotion, $Department){
    include('connection.php');
    $query = "INSERT INTO employe (nom, prenom, mail, souper, fk_cp, fk_locomotion, fk_departement) VALUES(:nom, :prenom, :mail, :souper, :fk_cp, :fk_locomotion, :fk_departement)";
    $query_params = array(':nom'=>$LastName,
                              ':prenom'=>$FirstName,
                                ':mail'=>$Email,
                                ':souper'=>$Diner,
                                ':fk_cp'=>$Postcode,
                                ':fk_locomotion'=>$Locomotion,
                                ':fk_departement'=>$Department);

        try{
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
            die("Failed query : " . $ex->getMessage());
        }
}

//insertDB("Doe", "John", "john.doe@outlook.com", "on", 1, 2, 2);
