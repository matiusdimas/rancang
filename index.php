<?php
include("control.php");
include('./partials/head.php');

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $sql = "SELECT id FROM users WHERE username='$user'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
    }
    if (isset($_POST['submit'])) {
        $laporan = $_POST['laporan'];
        if ($laporan > 0) {
            $sql = "INSERT INTO laporan (id_users, data_laporan) VALUES ('$id', '$laporan')";
            $result = mysqli_query($conn, $sql);
            echo '<script type="text/javascript">
    
            window.onload = function () { alert("Data Berhasil Ditambahkan Tinggal Tunggu Konfirmasi Admin"); }
    
            </script>';
        };
    };
    if (isset($_POST['submit'])) {
        $usulan = $_POST['usulan'];
        if ($usulan > 0) {
            $sql = "INSERT INTO usulan (id_users, usulan) VALUES ('$id','$usulan')";
            $result = mysqli_query($conn, $sql);
            echo '<script type="text/javascript">
    
                window.onload = function () { alert("Data Berhasil Ditambahkan Tinggal Tunggu Konfirmasi Admin"); }
    
                </script>';
        };
    };
    $err = false;
} else {
    $err = true;
};


$sqldatalaporan = "SELECT * FROM valid_laporan INNER JOIN users ON (valid_laporan.id_users=users.id) order by tanggal desc limit 4";
$sqldatausulan = "SELECT * FROM valid_usulan INNER JOIN users ON (valid_usulan.id_users=users.id) order by tanggal desc limit 4";
$resultlaporan = $conn->query($sqldatalaporan);
$resultusulan = $conn->query($sqldatausulan);
?>


<section class="my-10 mx-24  h-full">
    <header>
        <h1 class="font-bold text-2xl">
            Hallo Warga
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
                while ($row = $resultlaporan->fetch_assoc()) {
                    $template = "
                <div class='border-2 border-gray-400 bg-gray-100 overflow-hidden hover:overflow-auto px-4 w-52 my-5 py-5 h-40'>
                    <p class='text-sm'>" . $row['tanggal'] . "</p>
                    <h1 class='text-base font-semibold'> Bapak/Ibu " . $row['nama'] . "</h1>
                    <h1 class='text-base font-semibold'>" . $row['data_laporan'] . "</h1>
                
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
                while ($row = $resultusulan->fetch_assoc()) {
                    $template = "
                <div class='border-2 border-gray-400 bg-gray-100 overflow-hidden hover:overflow-auto px-4 w-52 my-5 py-5  h-40'>
                    <p class='text-sm '>" . $row['tanggal'] . "</p>
                    <h1 class='text-base font-semibold'> Bapak/Ibu " . $row['nama'] . "</h1>
                    <h1 class='text-base'>" . $row['data_usulan'] . "</h1>
                
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
    <form id="form" method="POST" class="border-2 border-gray-400 ">
        <div class="border-2 text-center pt-10 bg-gray-100 border-gray-100 grid">
            <h1 class="font-bold text-xl mb-10">Beri Masukan Anda Yang Terbaik</h1>
            <section class="grid grid-cols-1 lg:grid-cols-2 place-items-center ">
                <div class="">
                    <h1 class="font-semibold text-lg">Usulan</h1>
                    <textarea cols="40" rows="5" name="usulan" class="border-2 resize-none bg-gray-200 border-gray-300 p-5 " placeholder="Silahkan Masukan Usulan"></textarea>
                </div>

                <div class="">
                    <h1 class="font-semibold text-lg">Laporan</h1>
                    <textarea cols="40" rows="5" name="laporan" class="border-2 resize-none bg-gray-200 border-gray-300 p-5" placeholder="Silahkan Masukan Laporan"></textarea>
                </div>
            </section>
            <div id='err' class="hidden text-red-500">
                Silahkan <span><a href="login.php" class="underline text-blue-500">Login</a></span> Terlebih Dahulu
            </div>
            <button type="submit" class="mt-1 mb-3 block place-self-center text-white rounded-lg px-4 py-2 bg-blue-500 duration-200 hover:opacity-80" name="submit" id='btnSubmit'>Submit</button>
        </div>
    </form>
</section>

</section>
<?php
if ($err) {
?>
    <script>
        const btn = document.getElementById('btnSubmit')
        const err = document.getElementById('err')
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            err.classList.remove('hidden')
        })
    </script>
<?php
}; ?>

<?php
include('./partials/footer.php')
?>