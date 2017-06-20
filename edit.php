<?php 
  /*
    This script is used to show the edit page, if receive a non-numeric id, redirect the user back to the index page.

    Author: Zhiyue Zhao
    Date: February 13, 2016
    */
  require('authenticate.php');
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
    <title>My Blog-Edit <?= $row['title'] ?></title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="js/countWords.js" type="text/javascript"></script>
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
  <form action="process_post.php" method="post">
    <fieldset>
      <legend>Edit Blog Post</legend>
      <p>
        <label for="title">Title</label>
        <?= "<input name=\"title\" id=\"title\" value=\"". $row['title'] . "\" />" ?>
      </p>
      <p>
        <label for="content">Content</label>
        <?= "<textarea name=\"content\" id=\"content\">" . $row['content'] . "</textarea>" ?>
      </p>
      <p>
        <?= "<input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\" />" ?>
        <input type="submit" name="command" value="Update" onclick="return CountWords()"/>
        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
      </p>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2016 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
