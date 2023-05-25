<?php 
require('control.php');
$datahal=5;
$mysqli = mysqli_query($conn, "SELECT data_usulan FROM valid_usulan");
$jumlahdata=mysqli_num_rows($mysqli);
$jumlahHalaman= ceil($jumlahdata / $datahal);

$halamanaktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$awaldata = ($datahal*$halamanaktif) - $datahal;

$sqlvalusulan = "SELECT * FROM valid_usulan 
INNER JOIN users ON (valid_usulan.id_users=users.id) order by tanggal desc limit $awaldata ,$datahal";
$resultvalusulan= $conn->query($sqlvalusulan);

?>

<?php include('./partials/head.php') ?>
          <?php 
            if ($resultvalusulan->num_rows > 0) {
                // output data of each row
                while($row = $resultvalusulan->fetch_assoc()) {
                ?>
                <div class="p-5 border-b-2">
                  <p class="text-sm"><?php echo $row['tanggal'] ?></p>
                  <p class="text-lg font-semibold">Bapak/Ibu <?php echo $row['nama'] ?></p>
                  <p class="mb-5 text-lg"><?php echo $row['data_usulan'] ?></p>
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


<?php include('./partials/footer.php') ?>