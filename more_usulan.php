<?php 
require('control.php');


$datahal=5;
$mysqli = mysqli_query($conn, "SELECT data_usulan FROM valid_usulan");
$jumlahdata=mysqli_num_rows($mysqli);
$jumlahHalaman= ceil($jumlahdata / $datahal);

$halamanaktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$awaldata = ($datahal*$halamanaktif) - $datahal;

$sqlvalusulan = "SELECT * FROM valid_usulan order by id desc limit $awaldata ,$datahal";
$resultvalusulan= $conn->query($sqlvalusulan);

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

    <!-- nav start -->
    <nav class="w-full flex bg-[#0A4D68] text-white items-center gap-16 py-4 sticky top-0">
        <h1 class="text-2xl font-bold ml-10">Karang Taruna</h1>
        <h2>Data Usulan Warga</h2>
        <a href="index.php" class="px-4 py-2 rounded-lg bg-blue-500 duration-200 hover:opacity-80 text-white absolute z-20 right-10">Kembali</a>
    </nav>
    <!-- nav end -->

          <?php 
            if ($resultvalusulan->num_rows > 0) {
                // output data of each row
                while($row = $resultvalusulan->fetch_assoc()) {
                ?>
                <div class="p-5 border-b-2">
                  <p class="text-sm"><?php echo $row['tanggal'] ?></p>
                  <p class="mb-5 text-lg font-semibold"><?php echo $row['data_usulan'] ?></p>
                </div>

                <?php  
                }
              } else {
                echo "0 results";
              }
            ?>
        <div class="flex justify-center gap-2 my-5 sticky bottom-0">
            <?php if($halamanaktif > 1 && $resultvalusulan->num_rows > 0): ?>
              <a class="px-3 py-1 rounded-lg duration-75 border-2 hover:opacity-80 bg-blue-500 text-white" href="?hal=<?= $halamanaktif - 1 ?>">&lt;</a>
            <?php endif ?>
            <?php for($s=1 ;$s <= $jumlahHalaman ; $s++): ?>
              <?php if($s == $halamanaktif): ?>
                    <a class="px-3 py-1  text-base  rounded-lg duration-75 border-2 hover:opacity-80 bg-red-500 text-white" href="?hal=<?= $s ?>"><?= $s ?></a>
                <?php else : ?>    
                    <a class="px-3 py-1  text-base  rounded-lg duration-75 border-2 hover:opacity-80 bg-blue-500 text-white" href="?hal=<?= $s ?>"><?= $s ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if($halamanaktif < $jumlahHalaman): ?>
                <a class="px-3 py-1 rounded-lg duration-75 border-2 hover:opacity-80 bg-blue-500 text-white" href="?hal=<?= $halamanaktif + 1 ?>">&gt;</a>
            <?php endif ?>
        </div>
</body>
</html>