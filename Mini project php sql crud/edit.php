<?php 

    session_start();

    require_once "config/db.php";
    

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $nickname = $_POST['nickname'];

        $sql = $conn->prepare("UPDATE students SET first_name = :first_name, last_name = :last_name, nickname = :nickname WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":first_name", $first_name);
        $sql->bindParam(":last_name", $last_name);
        $sql->bindParam(":nickname", $nickname);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Data has been updated successfully";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
            header("location: index.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .container {
            max-width: 550px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Data</h1>
        <hr>
        <form action="edit.php" method="post" enctype="multipart/form-data">
            <?php
                if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $stmt = $conn->query("SELECT * FROM students WHERE id = $id");
                        $stmt->execute();
                        $data = $stmt->fetch();
                }
            ?>
                <div class="mb-3">
                    <label for="id" class="col-form-label">ID:</label>
                    <input type="text" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id" >
                    <label for="first_name" class="col-form-label">First Name:</label>
                    <input type="text" value="<?php echo $data['first_name']; ?>" required class="form-control" name="first_name" >
                </div>
                <div class="mb-3">
                    <label for="last_name" class="col-form-label">Last Name:</label>
                    <input type="text" value="<?php echo $data['last_name']; ?>" required class="form-control" name="last_name">
                </div>
                <div class="mb-3">
                    <label for="Nickname" class="col-form-label">Nickname:</label>
                    <input type="text" value="<?php echo $data['nickname']; ?>" required class="form-control" name="nickname">
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="col-form-label">Birthdate:</label>
                    <input type="text" value="<?php echo $data['birthdate']; ?>" required class="form-control datepicker" name="birthdate">
                </div>

            
                <hr>
                <a href="index.php" class="btn btn-secondary">Go Back</a>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
    </div>

</body>
</html>
