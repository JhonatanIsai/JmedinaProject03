<?php
    

    function deleteItem($itemNumber){
        require("./model/database.php"); 
        $query = "DELETE FROM todoitems WHERE ItemNum = :ItemNum";
        $statement = $db -> prepare($query);
        $statement -> bindValue(":ItemNum", $itemNumber);
        $statement -> execute();
        $statement -> closeCursor();

    }

       //Get the items from the form???
       function insertItem($title, $description, $category){
        require("./model/database.php");
        $sql = "insert INTO todoitems (Title, Description, categoryID)\n"

    . "VALUES (:title, :description, :categoryID)";
        $statement = $db -> prepare($sql);
        $statement -> bindValue(":title", $title);
        $statement -> bindValue(":description", $description);
        $statement -> bindValue(":categoryID", $category);
        $statement -> execute();
        $statement -> closeCursor();
    }




?>