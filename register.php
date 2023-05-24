<?php 
include('control.php');
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0){
                $sql = "INSERT INTO users (username, nama, email, password)
                        VALUES ('$username', '$nama', '$email', '$password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                    $username = "";
                    $email = "";
                    $_POST['password'] = "";
                    $_POST['cpassword'] = "";
                } else {
                    echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                }
            } else {
                echo "<script>alert('Woops! Username Sudah Terdaftar.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Woops! Password tidak sesuai')</script>";
    };
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Warga | Registrasi</title>
</head>
<body> 
    <div class="flex justify-center items-center h-screen">
        <form  method="POST" class="bg-slate-200 rounded-md p-24">
            <h1 class="text-4xl font-semibold text-center mb-5">Registrasi</h1>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" class="mb-3 border-2 rounded-md px-4 py-2" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" class="mb-3 border-2 rounded-md px-4 py-2" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Nama Anda" name="nama" class="mb-3 border-2 rounded-md px-4 py-2" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" class="mb-3 border-2 rounded-md px-4 py-2" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" class=" border-2 rounded-md px-4 py-2" required>
            </div>
            <div class=" bg-blue-500 mt-5 text-center text-white ">
                <button name="submit" class="px-3 py-1 btn w-full border-2">Submit</button>
            </div>
            <div class="text-red-500 my-1"><?php echo $err; ?></div>
            <div class="text-center">Sudah Punya Akun ? <a href="login.php" class="underline text-blue-500 hover:opacity-80 duration-200 "> Login </a></div>
        </form>
    </div>
</body>
</html>