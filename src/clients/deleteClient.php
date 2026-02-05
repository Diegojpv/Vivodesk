<?php
// ================================= DELETE CLIENT SCRIPT ================================= //
require_once  '../verification.php';

// We get the client ID from the url.
if(isset($_GET['clientId'])){

    try{
        // We prepare the SQL statement to delete the client from the database.
        $sql = "DELETE FROM clients WHERE user_id = :userId && client_id = :clientId";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'userId' => $userId ,
            'clientId' => $_GET['clientId']
        ]);
        // If the deletion is successful, we return a success message.
        if ($stmt->rowCount() > 0) {
            echo "success-client-deleted";
        } else {
            echo "Client not found or permission denied."; 
        }

    } catch(PDOException $e){
        echo "Error in the data base."; 
    }
}
?>