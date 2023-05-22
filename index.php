<?php 
include("control.php");

if (isset($_POST['submit'] )) {
    $usulan = $_POST['usulan'];
    if ($usulan > 0) {
        $sql = "INSERT INTO usulan (usulan) VALUES ('$usulan')";
        $result = mysqli_query($conn,$sql);
        echo '<script type="text/javascript">

            window.onload = function () { alert("Data Berhasil Ditambahkan Tinggal Tunggu Konfirmasi Admin"); }

            </script>';
    };
};

if (isset($_POST['submit'])) {
    $laporan = $_POST['laporan'];
    if ($laporan > 0) {
        $sql = "INSERT INTO laporan (data_laporan) VALUES ('$laporan')";
        $result = mysqli_query($conn,$sql);
        echo '<script type="text/javascript">

        window.onload = function () { alert("Data Berhasil Ditambahkan Tinggal Tunggu Konfirmasi Admin"); }

        </script>';
    };
};

$sqldatalaporan = "SELECT * FROM valid_laporan order by tanggal desc limit 4";
$sqldatausulan = "SELECT * FROM valid_usulan order by tanggal desc limit 4";
$resultlaporan = $conn->query($sqldatalaporan);
$resultusulan = $conn->query($sqldatausulan);
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Karang Taruna</title>
  <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="c16de592-ca89-46a7-9654-f8944b730e0d";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</head>
<body>
<section class="border-4 h-screen overflow-auto">
    <!-- nav start -->
    <nav class="w-full flex bg-[#0A4D68] text-white items-center gap-16 py-4 sticky top-0">
        <h1 class="text-2xl font-bold ml-10">Karang Taruna</h1>
        <ul class="flex gap-3 font-semibold">
            <li><a href="#laporan" class="px-4 py-2 text-lg block" >Laporan</a></li>
            <li><a href="#usulan" class="px-4 py-2 text-lg block" >Usulan</a></li>
            <li><a href="#masukan" class="px-4 py-2 text-lg block" >Masukan</a></li>
            <li><a href="kartukeluarga.php" class="px-4 py-2 text-lg block" >Cari Kartu Keluarga</a></li>
        </ul>
    </nav>
    <!-- nav end -->




    <section class="my-10 mx-24  h-full">
        <header >
            <h1 class="font-bold text-2xl">
                Hallo Kami, Karang Taruna 
                <span class="font-semibold text-lg">
                    RT001/RW002
                </span> 
            </h1>
        </header>

        <section id="laporan" class=" flex flex-col bg-gray-200 p-5 my-5 border-gray-400 border-2">
            <h1 class="text-lg font-semibold p-2 ml-2">Data Laporan Warga</h1>
            <div class="grid grid-cols-4  place-items-center">
            <?php 
            if ($resultlaporan->num_rows > 0) {
                // output data of each row
                while($row = $resultlaporan->fetch_assoc()) {
                $template = "
                <div class='border-2 border-gray-400 bg-gray-100 overflow-hidden hover:overflow-auto px-4 w-52 my-5 py-5 h-40'>
                    <p class='text-sm'>".$row['tanggal']."</p>
                    <h1 class='text-base font-semibold'>".$row['data_laporan']."</h1>
                
                </div>
                ";
                echo $template;

                }
              } else {
                echo "0 results";
              }
            ?>
             </div>
             <a href="more_laporan.php" class="self-end text-blue-500 underline duration-200 hover:opacity-80">Lihat Lebih Banyak Laporan</a>
        </section>
        <section id="usulan" class=" flex flex-col bg-gray-200 p-5 mb-5 border-gray-400 border-2">
            <h1 class="text-lg font-semibold p-2 ml-2">Data Usulan Warga</h1>
            <div class="grid grid-cols-4  place-items-center ">
            <?php 
            if ($resultusulan->num_rows > 0) {
                // output data of each row
                while($row = $resultusulan->fetch_assoc()) {
                $template = "
                <div class='border-2 border-gray-400 bg-gray-100 overflow-hidden hover:overflow-auto px-4 w-52 my-5 py-5  h-40'>
                    <p class='text-sm border-2'>".$row['tanggal']."</p>
                    <h1 class='text-base font-semibold'>".$row['data_usulan']."</h1>
                
                </div>
                ";
                echo $template;

                }
              } else {
                echo "0 results";
              }
            ?>
             </div>
             <a href="more_usulan.php" class="self-end text-blue-500 underline duration-200 hover:opacity-80">Lihat Lebih Banyak Usulan</a>
        </section>
        <form  id="masukan" method="POST" class="border-2 border-gray-400 ">
            <div class="border-2 text-center pt-10 bg-gray-100 border-gray-100 grid">
                <h1 class="font-bold text-xl mb-10">Beri Masukan Anda Yang Terbaik</h1>
                <section class="grid grid-cols-1 lg:grid-cols-2 place-items-center ">
                    <div class=""> 
                        <h1 class="font-semibold text-lg">Usulan</h1>
                            <textarea cols="40" rows="5" name="usulan"  class="border-2 resize-none bg-gray-200 border-gray-300 p-5 " placeholder="Silahkan Masukan Usulan"></textarea>
                    </div>

                    <div class=""> 
                            <h1 class="font-semibold text-lg">Laporan</h1> 
                            <textarea cols="40" rows="5" name="laporan"  class="border-2 resize-none bg-gray-200 border-gray-300 p-5" placeholder="Silahkan Masukan Laporan"></textarea>
                    </div>
                    
                </section>
                <button type="submit" class="my-5 block place-self-center text-white rounded-lg px-4 py-2 bg-blue-500 duration-200 hover:opacity-80" name="submit">Submit</button>

            </div>  
        </form>
        <div id="success"></div>
    </section>
   
</section>

<script src="js.js"></script>
</body>
</html>