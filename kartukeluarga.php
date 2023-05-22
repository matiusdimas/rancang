<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Cari Kartu Keluarga</title>
</head>
<body>
<section class="border-4 h-screen overflow-auto">
    <!-- nav start -->
    <nav class="w-full flex bg-[#0A4D68] text-white items-center gap-16 py-4 sticky top-0">
        <h1 class="text-2xl font-bold ml-10">Karang Taruna</h1>
        <ul class="flex gap-3 font-semibold">
            <li><a href="index" class="px-4 py-2 text-lg block" >Laporan</a></li>
            <li><a href="#" class="px-4 py-2 text-lg block" >Cari Kartu Keluarga</a></li>
        </ul>
    </nav>

    <section class="justify-center mt-[10rem] grid">
        <div class="">
            <h1 class="text-xl font-semibold mb-5">Cari Data Kartu Keluarga</h1>
            <div>
                <input type="number" placeholder="Masukan No KK/KTP" class="border-2 mb-2 rounded-md p-2" >
            </div>
            <div>
                <input type="search" placeholder="Nama Kepala Keluarga" class="border-2 rounded-md p-2" >
            </div>
            <button type="submit" class="px-3 py-2 bg-blue-500 text-white mt-4 rounded-md">Submit</button>
        </div>
    </section>
</section>
    
</body>
</html>