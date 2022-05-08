<?php
if (isset($_GET['id'])) {
    include 'config.php';
    $querySelect = 'select * from book where id=' . $_GET['id'];
    $ResultSelectStmt = mysqli_query($conn, $querySelect);
    $fetchRecords = mysqli_fetch_assoc($ResultSelectStmt);
    $createDeletePath  = 'image/' . $fetchRecords['book_pic'];
    if (unlink($createDeletePath)) {
      $sql = "delete from book where id=" . $_GET["id"];
      $rsDelete = mysqli_query($conn, $sql);
      if ($rsDelete) {
        header('location:book_mangment.php?success=true');
        exit();
      }
    }
  }
?>