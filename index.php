<!--Jhonatan Medina
    Project 4
    Week 5
    March 1, 2021
    
    -->
    <?php 
    require("./model/database.php"); //connect to data base
    $footer = require("./model/footer.php");
    $header = require("./model/header.php");

 

    $taskTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    $taskDescription = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
    $taskCategory = filter_input(INPUT_POST, "categoryDrop", FILTER_SANITIZE_NUMBER_INT);

   
    
    $query = 'SELECT * FROM todoitems'; // Query to retrieve items from the data base

    //Get the data fromthe database out
    $statement = $db ->prepare($query);
    $statement ->execute();
    $todolist = $statement -> fetchAll();
    $statement -> closeCursor();

?>

    
     

<?php $header ?>
<body>
    <main>
        <header class="pageTitle">
            <h1 >To Do List</h1>
        </header>
        <div>
        <!--.......................................INPUT FORM........................................................-->
            <div>
                <h2>Add Task</h2>
            </div>
            <!--Input Area-->
            <form class="inputArea" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

                <!--Task Name-->
                <label class="labelName" for="title">Title</label>
                <input type="text" class="taskBox" id="title" name="title" required><br>

                <!--Task Description-->
                <label class="labelName" for="description"> Description</label>
                <input type="text" class="taskBox" id="description" name="description"><br>

                <!--Choose category -->
                <label class="labelName" for="categoryDrop">Category:</label>

                <select class="category" name="categoryDrop" id="categoryDrop" >
                    <?php foreach(categories() as $Mycategory):?>
                        <?php echo $Mycategory['categoryID']; ?> <!--LEFT OFF HERE--->
                        <option class="category" value="<?php echo $Mycategory['categoryID']?>"><?php echo $Mycategory['categoryName']?></option> <!--ADD Style -->
                       
                    <?php endforeach;?>
                </select>
                <input type="submit" name="submit" class="button"?>
                <!--..................................................................................................-->
            
                </form>
            

        <!--.......................................TASK DISPLAY AREA ........................................................-->
        <div class="tasksList">
            <h2 class="labelName">My Tasks</h2>
            <?php
                require("./model/database.php");
            ?>
            <?php foreach ($todolist as $customer) : ?>
                <div class="task">
                    <div class="taskBlock">
                    <!--Task Title-->
                    <p><span>Title:</span> <?php echo $customer['Title']; ?></p> 
                    <!--Task Description-->
                    <p><span>Description:</span> <?php echo $customer['Description']; ?></p>
                    </div>

                    <!--Submit Button-->
                    <input class="button"  type="button" onclick="<?php deleteItem( $customer['ItemNum'])?>">
                    
                       <!--Category ID-->
                       <div class="categoryBlock">
                    <p><span>Category:</span> <?php echo getcategories($customer["categoryID"])[0] ?></p>

                    <input class="button" type="button" onclick="<?php categories()?>"> <!--Make function to delete-->
                    </div>
                </div>
               
                <?php endforeach;?>

        </div>
        </div>
        
    </main>
    
    
</body>

<?php $footer.footer(); ?>