<?php 
  /*
    This script is used to show the create page, and check the authentication of the user

    Author: Zhiyue Zhao
    Date: February 13, 2016
    */
  require('authenticate.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Blog-Post a New Blog</title>
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
        <li><a href="create.php" class='active'>New Post</a></li>
    </ul> <!-- END div id="menu" -->
    <div id="all_blogs">
      <form action="process_post.php" method="post">
        <fieldset>
          <legend>New Blog Post</legend>
          <p>
            <label for="title">Title</label>
            <input name="title" id="title" />
          </p>
          <p>
            <label for="content">Content</label>
            <textarea name="content" id="content"></textarea>
          </p>
          <p>
            <input type="submit" name="command" value="Create" onclick="return CountWords()"/>
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
