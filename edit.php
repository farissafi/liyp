
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
    if (isset($_GET['id'])) {
        include "config.php";
        $sqlGetDepData = "select * from book where id=" . $_GET['id'];
        $result = mysqli_query($conn, $sqlGetDepData);
        $row = mysqli_fetch_assoc($result);
        if (isset($_POST['submit'])) {
            $book_name = $_POST['book_name'];
            $page_number = $_POST['page_number'];
            $book_year = $_POST['book_year'];
            $book_auther = $_POST['book_auther'];
            $book_categories = $_POST['book_categories'];
            $book_description = $_POST['book_description'];
            if (file_exists($_FILES['book_pic']['tmp_name'])) {
                $old_img_path = "image/" . $row['book_pic'];
                unlink($old_img_path);
                $new_img_name = $_FILES['book_pic']['name'];
                $expload_name = explode(".", $new_img_name);
                $ext = end($expload_name);
                $imageName = "img" . time() . "." . $ext;
                move_uploaded_file($_FILES['book_pic']['tmp_name'], 'image/' . $imageName);
                $sql = "update book set book_name='$book_name',page_number='$page_number',book_year='$book_year',book_auther='$book_auther',
                book_categories='$book_categories',book_description='$book_description',book_pic='$imageName' where id=" . $_GET['id'];
                $res = mysqli_query($conn, $sql);
                header('location:book_mangment.php?success=true');
                exit();
            } else {

                $sql = "update book set book_name='$book_name',page_number='$page_number',book_year='$book_year',book_auther='$book_auther',
                book_categories='$book_categories',book_description='$book_description' where id=" . $_GET['id'];
                $res = mysqli_query($conn, $sql);
                header('location:book_mangment.php?success=true');
                exit();
            }
        }
    }
    ?>
    <div class="container">

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"> اسم الكتاب </label>
                <input type="text" name="book_name"value="<?php echo $row['book_name'] ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label"> عدد صفحات الكتاب </label>
                <input type="text" name="page_number" value="<?php echo $row['page_number'] ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"> سنة الاصدار </label>
                <input type="text" value="<?php echo $row['book_year'] ?>"
 name="book_year" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"> المؤلف </label>
                <input type="text" value="<?php echo $row['book_auther'] ?>"
 name="book_auther" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"> تصنيف الكتاب </label>
                <select name="book_categories" id="inputCategory" class="form-select">
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
                <label for="exampleInputEmail1" class="form-label"> وصف الكتاب    </label>
                <input class="form-control"  name="book_description" value="<?php if(isset($row['book_description'])) echo $row['book_description']?>"  id="" cols="30" rows="10"> </input>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">صورة الكتاب </label>
                <input type="file" name="book_pic"  class="form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">ارسال </button>
            <a href="logout.php" type="submit" name="submit" class="btn btn-danger">الغاء </a>


        </form>
    </div>
</body>

</html>