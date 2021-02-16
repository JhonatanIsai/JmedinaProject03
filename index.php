<!--Jhonatan Medina
    Project 3
    Week 4
    February 15, 2021
    
    -->
<?php 
    require('database.php');

    //Get the items from the form???

    function insertItem($title, $descrip){ 
        //Insert items into the database
        require('database.php');
        $insertQuery ='INSERT INTO todoitems(ItemNum,Title,Description)
        VALUES("", :taskTitle, :taskDescription)';

        $returnStatment = $db ->prepare($insertQuery);
        $returnStatment -> bindValue(':taskTitle',$title);
        $returnStatment -> bindValue(':taskDescription',$descrip);
        $returnStatment -> execute();
        $returnStatment -> closeCursor();

    }


    $taskTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    $taskDescription = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

    

   
    
    $query = 'SELECT * FROM todoitems'; // Query to retrieve items from the data base

    //Get the data fromthe database out
    $statement = $db ->prepare($query);
    $statement ->execute();
    $todolist = $statement -> fetchAll();
    $statement -> closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./scss/style.css">

    <title>To Do List</title>
</head>
<body>
    <main>
        <header class="pageTitle">
            <h1 >To Do List</h1>
        </header>
        <div>
            <div>
                <h2>Add Task</h2>
            </div>
            <form class="inputArea" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <label class="labelName" for="title">Title</label>
                <input type="text" class="taskBox" id="title" name="title"><br>
                
                <label class="labelName" for="description"> Description</label>
                <input type="text" class="taskBox" id="descriptin" name="description"><br>
                
                <input type="submit" class="button">
            
            </form>
        

        <div class="tasksList">
            <h2 class="labelName">My Tasks</h2>
            <?php
                require("database.php");
                insertItem($taskTitle, $taskDescription);
            ?>
            <?php foreach ($todolist as $customer) : ?>
                <div class="task">
                <p><span class="bold">Task Number:</span> <?php echo $customer['ItemNum']; ?></p>
                <p><span class="bold">Title:</span> <?php echo $customer['Title']; ?></p>
                <p><span class="bold">Description:</span> <?php echo $customer['Description']; ?></p>
                <input class="button"  type="button" onclick="deleteItem( $customer['ItemNum'])">
               
                </div>
                <?php endforeach;?>

        </div>
        </div>
    </main>
    
    
</body>
</html>