<?php
      function categories()
      {
          require("./model/database.php");
          $categoryQuery = "SELECT * FROM categories";
          $categoryStatement = $db -> prepare($categoryQuery);
          $categoryStatement->execute();
          $categories = $categoryStatement ->fetchAll();
          $categoryStatement ->closeCursor();
          
          return $categories;
      }
  

  function getcategories($catNumber){
      require("./model/database.php");
      $getQuery = "SELECT categories.categoryName FROM categories WHERE categories.categoryID = :catNum ";
      $returnStatment = $db ->prepare($getQuery);
      $returnStatment-> bindValue(":catNum", $catNumber);
      $returnStatment -> execute();
      $myCatReturn = $returnStatment -> fetch();
      $returnStatment -> closeCursor();
      return $myCatReturn;
  }

?>