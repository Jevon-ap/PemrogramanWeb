<?php 
include 'config.php';
session_start();
error_reporting(0);


if (isset($_POST['submit'])) {
    $email1=$_POST['email'];
    $password=md5($_POST['password']);

    $sql4="SELECT *FROM users WHERE email='$email1' AND password='$password'";
    $result=mysqli_query($koneksi,$sql4);
    if($result->num_rows >0){
        echo"<script> alert('Selamat , Login berhasil') </script>";
        $row=mysqli_fetch_assoc($result);
        $_SESSION['username']=$row['username'];

        if(!empty($_POST['check'])){
            $check=$_POST['check'];
            setcookie('email',$email1,time()+60*60*24*30);
            setcookie('password',$password,time()+60*60*24*30);
        }else{
            setcookie('email',$email1,30);
            setcookie('password',$password,30);
        }

        if (isset($_SESSION['username'])) {
            header("Location: main.php");
        }
    }else{
        echo"<script> alert('Maaf terjadi kesalahan') </script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .container {
            margin: auto;
            max-width: 35%;
            padding-top: 5%;
        }
    </style>
</head>

<body background="./bg.jpg">
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Login
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($_COOKIE['email'])) {
                            echo $_COOKIE['email'];
                        }  ?>">
                    </div>
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?php if (isset($_COOKIE['password'])) {
                            echo $_COOKIE['password'];
                        } ?>" >
                    </div>
                    <div class="mb-3">
                        <input type="submit"name="submit" id="submit">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox"name="check" id="check">Remember Me
                    </div>
                    <p>don,t have account ? click<a href="./register.php"> here</a></p>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>