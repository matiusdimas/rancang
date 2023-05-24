<?php 
include('control.php');
session_start();
$page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warga</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
  
  <section class="h-screen overflow-auto">
  <nav class="w-full flex bg-[#0A4D68] text-white items-center gap-16 py-4 sticky top-0">
        <h1 class="text-2xl font-bold ml-10">Warga</h1>
        <ul class="flex gap-3 font-semibold">
            <li><a href="index.php" class="<?= $page == 'index.php' ? "px-4 py-2 text-xl block text-rose-500 underline" : "px-4 py-2 text-lg block hover:opacity-80 duration-200"?>" >Home</a></li>
            <li><a href="more_laporan.php" class="<?= $page == 'more_laporan.php' ? "px-4 py-2 text-xl block text-rose-500 underline" : "px-4 py-2 text-lg block hover:opacity-80 duration-200"?>" >Data Laporan</a></li>
            <li><a href="more_usulan.php" class="<?= $page == 'more_usulan.php' ? "px-4 py-2 text-xl block text-rose-500 underline" : "px-4 py-2 text-lg block hover:opacity-80 duration-200"?>" >Data Usulan</a></li>
            <li><a href="index.php#form" class="px-4 py-2 text-lg block hover:opacity-80 duration-200" >Input Masukan</a></li>
        </ul>

        <?php 
          if (isset($_SESSION['username'])) { ?>
            <div class="font-semibold text-lg flex flex-wrap mt-1 gap-3 ml-auto mr-16  ">
                <h1><?php echo $_SESSION['username'] ?></h1>
                <div class="bg-slate-500 cursor-pointer py-1 px-4" id='user-btn'>
                </div>
                <ul class="hidden absolute top-[76px] right-16 bg-slate-100 pl-4 pr-10 py-2 rounded-b-md text-black" id="user-list">
                  <li><a href="logout.php" class="">Logout</a></li>
                </ul>
            </div>
          
          <?php } else { ?>
            <a href="login.php" class="px-3 py-1 bg-blue-500 rounded-md ml-auto mr-16 text-lg font-semibold hover:opacity-80 duration-200">Login</a>
          <?php } ?>
        
  </nav>