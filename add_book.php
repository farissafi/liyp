<?php
session_start();
if (!isset($_SESSION['id'])) {

  header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>Document</title>
</head>

<body>
  <?php
  if (isset($_POST['submit'])) {
    $book_name = $_POST['book_name'];
    $page_number = $_POST['page_number'];
    $book_year = $_POST['book_year'];
    $book_auther = $_POST['book_auther'];
    $book_categories = $_POST['book_categories'];
    $book_description = $_POST['book_description'];
    $user_id = $_SESSION['id'];
    if (file_exists($_FILES['book_pic']['tmp_name'])) {
      $old_img_name = $_FILES['book_pic']['name'];
      $expload_name = explode(".", $old_img_name);
      $ext = end($expload_name);
      $imageName = "img" . time() . "." . $ext;
      move_uploaded_file($_FILES['book_pic']['tmp_name'], 'image/' . $imageName);
      $sql = "insert into book (user_id,book_name,page_number,book_year,book_auther,book_categories,book_description,book_pic) values ('$user_id','$book_name','$page_number','$book_year','$book_auther','$book_categories','$book_description','$imageName')";
      include "config.php";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $msg = '<div class="alert alert-success" role="alert">
                      تمت عملية الاضافة بنجاح
                    </div>';
      } else {
        $msg = '<div class="alert alert-danger" role="alert">
                      لم تتم عملية الاضافة بنجاح
                    </div>';
      }

      mysqli_close($conn);
    }
  }
  ?>
  <div class="container">

    <form method="POST" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"> اسم الكتاب </label>
        <input type="text" name="book_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

      </div>
      <div class="mb-3">

        <label for="exampleInputEmail1" class="form-label"> عدد صفحات الكتاب </label>
        <input type="text" name="page_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"> سنة الاصدار </label>
        <input type="text" name="book_year" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"> المؤلف </label>
        <input type="text" name="book_auther" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

      </div>




      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"> تصنيف الكتاب </label>
        <select name="book_categories " id="inputCategory" class="form-select">
          <?php
          include "config.php";
          $sql = "select * from category";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            foreach ($result as $key => $row) {
              echo '
		<option value="' . $row['id'] . '">' . $row['title'] . '</option>
		';
            }
          }
          ?>
        </select>
      </div>





      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"> وصف الكتاب </label>
        <input type="text" name="book_description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">صورة الكتاب </label>
        <input type="file" name="book_pic" class="form-control" id="exampleInputPassword1">
      </div>

      <button type="submit" name="submit" class="btn btn-primary">ارسال </button>
      <a href="logout.php" type="submit" name="submit" class="btn btn-danger">الغاء </a>


    </form>
  </div>
</body>

</html>