<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "./links.php" ?>
</head>

<body>

    <?php

    include "./config.php";

    if (isset($_POST['submit'])) {
        $username = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['mobile'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $Cpass = password_hash($cpassword, PASSWORD_BCRYPT);
        $query = "SELECT * FROM registration WHERE email = :email";
        $prep = $conn->prepare($query);
        $prep->bindParam(':email', $email);
        $prep->execute();
        $res = $prep->fetchAll();
        if (count($res) > 0) {
            echo "email already exist";
        } else {
            if ($password === $cpassword) {
                // $insert = "INSERT INTO registration (usernam, mobile, password, cpassword, email) 
                // VALUES (:username, :phone, :pass, :Cpass, :email)";
                // $prep = $conn->prepare($insert);
                // $prep->bindParam(':username', $username);
                // $prep->bindParam(':phone', $phone);
                // $prep->bindParam(':pass', $pass);
                // $prep->bindParam(':Cpass', $Cpass);
                // $prep->bindParam(':email', $email);
                // $res = $prep->execute();
                $stmt = $conn->prepare("INSERT INTO registration (usernam, mobile, password, cpassword, email) VALUES (?, ?, ?, ?, ?)");
                $res = $stmt->execute([$username, $phone, $password, $cpassword, $email]);
                if ($res) {
                    echo "insert success";
                } else {
                    echo "not";
                }
            } else {
                echo "pass not match";
            }
        }
        // var_dump($res);
    }
    ?>

    <div class="container mt-5">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Full name </label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Phone Number</label>
                <input type="number" name="mobile" class="form-control" id="number" aria-describedby="number">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" name="cpassword" class="form-control" id="cpassword">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

</body>

</html>