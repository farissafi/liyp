<!DOCTYPE html>
<html lang="ar" dir="rtl" >

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>Document</title>
</head>

<body>
<div class="row">
  <?php
include "config.php";
$sql = "select * from book";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  $key = 0;
  while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <div class="col-3">
      <div class="card">
        <img src="image/'.$row['book_pic'].'" class="card-img-top" alt="">
        <div class="card-body">
          <h5 class="card-title">'.$row['book_name'].'</h5>
          <p class="card-text">'.$row['book_auther'].'</p>
          <a href="#" class="btn btn-primary">اقرا التفاصيل </a>
        </div>
      </div>
    </div>
        
        ';
  }
} else {
  echo '<tr class="align-middle">
     <td colspan="5" scope="row">لا يوجد بيانات يمكن عرضها...</td>
 </tr>';
}


  ?>



    
  </div>





</body>

</html>