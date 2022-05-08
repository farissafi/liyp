<?php session_start(); ?>;
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
  $msg = "";
  if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    if (empty($username)) {
      $msg = "<div class='alert alert-danger' role='alert'>
          الرجاء ادخال اسم المستخدم
         </div>";
    } elseif (empty($_POST['password'])) {
      $msg = "<div class='alert alert-danger' role='alert'>
        الرجاء ادخال كلمة المرور
       </div>";
    } else {
      include "config.php";
      $sql = "select * from user where username='$username' and password='$password'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) == 0) {
        $msg = "<div class='alert alert-danger' role='alert'>
            خطأ في اسم المستخدم و كلمة المرور
           </div>";
      } else {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $user['id'];
        $_SESSION['user'] = $user['username'];
        $_SESSION['isAdmin'] = $user['isAdmin'];
        $_SESSION['state'] = true;
        header('Location:book_mangment.php');
      }
    }
  }
  ?>
  <div class="container card my-5 w-25">
    <form method="POST">
      <img src="image/img15.png" width="330rem">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"> اسم المستخدم </label>
        <input type="username" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">كلمة المرور </label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      </div>

      <button type="submit" name="submit" class="btn btn-primary">ارسال </button>
    </form>
  </div>
</body>

</html>