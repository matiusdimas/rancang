<?php 
include('control.php');
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username']; 
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: index.php");
    } else {
        $err = 'Username Atau Password Salah';
    }
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Warga | Login</title>
</head>
<body> 
    <div class="flex justify-center items-center h-screen">
        <form  method="POST" class="bg-slate-200 rounded-md p-32">
            <h1 class="text-4xl font-semibold text-center mb-5">Login</h1>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" class="mb-3 border-2 rounded-md px-4 py-2" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password"  class=" border-2 rounded-md px-4 py-2" required>
            </div>
            <div class=" bg-blue-500 mt-5 text-center text-white ">
                <button name="submit" class="px-3 py-1 btn w-full border-2">Login</button>
            </div>
            <div class="text-red-500 my-1"><?php echo $err; ?></div>
            <div>Belum Punya Akun ? <a href="register.php" class="underline text-blue-500 hover:opacity-80 duration-200"> Registrasi </a></div>
        </form>
    </div>
</body>
</html>