<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location:login.php');
} ?>
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
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="row">
      <div class="col-3">
        <a href="add_book.php" type="button" class="btn btn-primary">اضف جديد</a>
      </div>
      <div class="col-6">

      </div>
      <div class="col-3">
        <a href="logout.php" type="button" class="btn btn-danger">تسجيل خروج</a>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">اسم الكتاب </th>
          <th scope="col">المؤلف </th>
          <th scope="col">سنة الاصدار </th>
          <th scope="col">عدد الصفحات</th>
          <th scope="col">تصنيف الكتاب </th>
          <th scope="col">صورة الكتاب </th>
          <th scope="col">عمليات </th>

        </tr>
      </thead>
      <tbody>
        <?php
        if ($_SESSION['isAdmin'] == 1) {
          include "config.php";
          $sql = "select book.*,category.id as cid , category.title from book  join category on book.book_categories = category.id ";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            $key = 0;
            while ($row = mysqli_fetch_assoc($result)) {
              echo '
            <tr class="align-middle">
              <th scope="row">' . ++$key . '</th>
              <td>' . $row['book_name'] . '</td>
              <td>' . $row['book_auther'] . '</td>
              <td>' . $row['book_year'] . '</td>
              <td>' . $row['page_number'] . '</td>
              <td>' . $row['title'] . '</td>
              <td><img width="100px" src="image/' . $row['book_pic'] . '" ></td>
              <td><a href="edit.php?id=' . $row['id'] . '" class="btn btn-danger">edit</a></td>
              <td><a href="delet.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a></td>
            </tr>
            
            ';
            }
          } else {
            echo '<tr class="align-middle">
         <td colspan="9" scope="row">لا يوجد بيانات يمكن عرضها...</td>
     </tr>';
          }
        } else {
          include "config.php";
          $sql = "select book.*,category.id as cid , category.title from book  join category on book.book_categories = category.id and user_id = " . $_SESSION['id'];
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            $key = 0;
            while ($row = mysqli_fetch_assoc($result)) {
              echo '
            <tr class="align-middle">
              <th scope="row">' . ++$key . '</th>
              <td>' . $row['book_name'] . '</td>
              <td>' . $row['book_auther'] . '</td>
              <td>' . $row['book_year'] . '</td>
              <td>' . $row['page_number'] . '</td>
              <td>' . $row['title'] . '</td>
              <td><img width="100px" src="image/' . $row['book_pic'] . '" ></td>
              <td><a href="edit.php?id=' . $row['id'] . '" class="btn btn-danger">edit</a></td>
              <td><a href="delet.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a></td>
            </tr>
            
            ';
            }
          } else {
            echo '<tr class="align-middle">
         <td colspan="9" scope="row">لا يوجد بيانات يمكن عرضها...</td>
     </tr>';
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>