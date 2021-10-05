<?php 
include 'config.php';

session_start();

if (isset($_POST["submit"])) {
    $username=$_POST['username'];
    $email1=$_POST['email'];
    $password=md5($_POST['password']);
    $cpassword=md5($_POST['cpassword']);

    if ($password==$cpassword) {
        $sql3="INSERT INTO users(username,email,password)
            VALUE('$username','$email1','$password')";
        $con=mysqli_query($koneksi,$sql3);
        if($con){
            echo"<script> alert('Selamat , Registrasi berhasil') </script>";
            $username="";
            $email1="";
            $_POST['password']="";
            $_POST['cpassword']="";
        }else{
            echo"<script> alert('Maaf terjadi kesalahan') </script>";
        }
    }else{
        echo "password tidak sama";
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

    <title>Register</title>
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
                REGISTER
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required value="<?php echo "$username";?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"required value="<?php echo "$email1";?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password"required value="<?php echo "$password";?>">
                    </div>
                    <div class="mb-3">
                        <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="text" class="form-control" id="cpassword" name="cpassword"required value="<?php echo "$cpassword";?>">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="submit" id="submit">
                    </div>
                    <p>have account ? click<a href="./login.php"> here</a></p>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>