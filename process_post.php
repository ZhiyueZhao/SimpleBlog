<?php
    /*
    This script is used to handle inserts, updates, and deletes against the blogposts table

    Author: Zhiyue Zhao
    Date: February 13, 2016
    */
    require('connect.php');

    //when post command is delete
    if ($_POST['command'] == "Delete")
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        //  Build the parameterized SQL query and bind to the above sanitized values.
        //:author named statement
        $query = "DELETE FROM myblog WHERE id = :id";
        $statement = $db->prepare($query);

        //  Bind values to the parameters
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        //execute the query
        if ($statement->execute())
        {
            header('Location: index.php');
            exit;
        }
    }
    //could post
    if ($_POST && isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) 
    {
        $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        //if(filter_has_var(INPUT_POST, "id"))
        //come from create page
        if ($_POST['command'] == "Create")
        {
            //  Build the parameterized SQL query and bind to the above sanitized values.
            //:author named statement
            $query = "INSERT INTO myblog (title, content) VALUES (:title, :content)";
            $statement = $db->prepare($query);

            //  Bind values to the parameters
            $statement->bindValue(':title', $title);
            $statement->bindValue(':content', $content);
        
        }
        //come from edit page and post command is Update
        else
        {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            //  Build the parameterized SQL query and bind to the above sanitized values.
            //:author named statement
            $query = "UPDATE myblog SET title = :title, content = :content WHERE id = :id";
            $statement = $db->prepare($query);

            //  Bind values to the parameters
            $statement->bindValue(':title', $title);        
            $statement->bindValue(':content', $content);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
        }
        //execute the query
        if ($statement->execute())
        {
            header('Location: index.php');
            exit;
        }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Error Page</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Go back to index page!</a></h1>
        </div> <!-- END div id="header" -->
        <h1>An error occured while processing your post.</h1>
        <p>Both the title and content must be at least one character.  </p>
        <a href="index.php">Return Home</a>
        <div id="footer">
            Copywrong 2016 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
