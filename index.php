<?php
    /*
    This script is used to show the blogs in the database

    Author: Zhiyue Zhao
    Date: February 13, 2016
    */

    require('connect.php');
    require('dataFormat.php');

    // SQL is written as a String.
    $query = "SELECT * FROM myblog ORDER BY id DESC";

    // A PDO::Statement is prepared from the query.
    $statement = $db->prepare($query);

    // Execution on the DB server is delayed until we execute().
    $statement->execute(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Blog-Home Page</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
      <div id="header">
          <h1><a href="index.php">My Amazing Blog</a></h1>
      </div> <!-- END div id="header" -->
      <!--<div id="pageType">
          <h3>Recently Posted Entries</h3>
      </div>  END div id="header" -->
      <ul id="menu">
          <li><a href="index.php" class='active'>Recently Posted Blog Entries</a></li>
          <li><a href="create.php" >New Post</a></li>
      </ul> <!-- END div id="menu" -->
      <div id="all_blogs">
        <!-- Fetch each table row in turn. Each $row is a table row hash.
        Fetch returns FALSE when out of rows, halting the loop. shows only recently 5 blogs-->
        <?php $i = 1 ?>
        <?php while(($row = $statement->fetch()) && ($i<=5)): ?>
        <!--The Row data is retrieved as string keys on the row hash-->
          <?php $i++ ?>
          <div class="blog_post">
            <?= "<h2><a href=\"show.php?id=". $row['id']. "\">". $row['title'] . "</a></h2>" ?>
            <p>
              <small>
                <?= format_datetime($row['createDate']) ?> -
                <?= "<a href=\"edit.php?id=". $row['id']. "\">edit</a>" ?>
              </small>
            </p>
            <div class='blog_content'>
              <?php if (strlen($row['content'])>200): ?>
                <?= substr($row['content'],0,199) ?>
                <?= "<a href=\"show.php?id=". $row['id']. "\">Read Full Post</a>" ?>
              <?php else: ?>
                <?= $row['content'] ?>
              <?php endif ?>
            </div><!-- END div class="blog_content" -->
          </div><!-- END div class="blog_post" -->
        <?php endwhile ?>
      </div><!-- END div id="menu" -->
      <div id="footer">
        Copywrong 2016 - No Rights Reserved
      </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
