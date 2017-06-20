<?php 
  /*
    This script is used to show the full blog when the blog is longer than 200 characters.

    Author: Zhiyue Zhao
    Date: February 13, 2016
    */
  require('dataFormat.php');
  require('connect.php');
  //could get
  if ($_GET != null) 
  {
    // Build and prepare SQL String with :id placeholder parameter.
    $query = "SELECT * FROM myblog WHERE id = :id LIMIT 1";
    $statement = $db->prepare($query);
    
    // Sanitize $_GET['id'] to ensure it's a number.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Bind the :id parameter in the query to the sanitized
    // $id specifying a binding-type of Integer.
    $statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();
    //echo $statement->rowCount();
    // Fetch the row selected by primary key id.
    $row = $statement->fetch();
    //no return
    if (empty($row))
    {
      header('Location: index.php');
      exit;
    }
  }
  //could not get
  else
  {
    header('Location: index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Blog-<?= $row['title'] ?></title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <div id="wrapper">
    <div id="header">
      <h1><a href="index.php">My Amazing Blog</a></h1>
    </div> <!-- END div id="header" -->
    <ul id="menu">
        <li><a href="index.php" >Home</a></li>
        <li><a href="create.php" >New Post</a></li>
    </ul> <!-- END div id="menu" -->
    <div id="all_blogs">
      <div class="blog_post">
        <h2><?= $row['title'] ?></h2>
        <p>
          <small>
            <?= format_datetime($row['createDate']) ?> -
            <?= "<a href=\"edit.php?id=". $row['id']. "\">edit</a>" ?>
          </small>
        </p>
        <div class='blog_content'>
          <?= $row['content'] ?>
        </div>
      </div>
    </div>
    <div id="footer">
      Copywrong 2016 - No Rights Reserved
    </div> <!-- END div id="footer" -->
  </div> <!-- END div id="wrapper" -->
</body>