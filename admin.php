<?php
  require 'functions.php';
  $listProduk = query("SELECT produk.id_produk, produk.nama_produk,
  produk.harga, kategori.nama_kategori, produk.stok, produk.gambar, 
  produk.deskripsi 
  FROM produk 
  INNER JOIN kategori 
  ON produk.kategori_id = kategori.id_kategori");
  $listKategori = query("SELECT * FROM kategori");
  if(isset($_POST["cari"])) { 
    $listProduk = cari($_POST["key"]);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/style.css">
  <style>
    nav {
      padding: 0 20px;
      height: 70px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    nav .back {
      color: black;
      text-decoration: underline;
    }
    .aksi {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }
    .aksi input {
      width: 300px;
      height: 30px;
      padding-left: 15px;
      border: 1px solid rgba(0, 0, 0, 0.308);
      border-radius: 3px;
      outline: none;
    }
    .aksi button {
      height: 32px;
      width: 32px;
      color: white;
      border-radius: 3px;
      border: none;
      background-color: rgb(90, 128, 255);
      transition: .2s;
      cursor: pointer;
    }
    .aksi button:hover {
      background-color: #5276eb;
    }
    .aksi .tambah {
      display: inline-block;
      padding: 8px 30px;
      color: white;
      background-color: #198754;
      border-radius: 3px;
      transition: .2s;
    }
    .aksi .tambah:hover {
      background-color: #17784b;
    }
    .hapus, .edit {
      display: inline-block;
      padding: 5px 9px;
      color: white;
      background-color: #dc3545;
      border-radius: 3px;
      transition: .2s;
    }
    .hapus {
      background-color: #dc3545;
    }
    .hapus:hover {
      background-color: #cc3140;
    }
    .edit {
      background-color: #0d6efd;
    }
    .edit:hover {
      background-color: #0c66eb;
    }
    main {
      padding: 0 20px;
      height: 100vh;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    tr {
      border: 1px solid #dddddd;
    }
    th  {
      background-color: black;
      color: white;
    }
    th, td {
      border-bottom: 1px solid #dddddd;
      text-align: center;
      padding: 8px;
    }
    td img {
      width: 75px;
      height: 75px;
    }
    .data {
      display: flex;
      align-items: start;
      flex-direction: column;
      gap: 20px;
    }
  </style>
</head>
<body>
  <nav>
    <h1>Admin</h1>
    <a class="back" href="home.php">back</a>
  </nav>
  <main>
    <div class="aksi">
      <form action="" method="post">
        <input type="text" name="key" id="key" placeholder="serach" autocomplete="off" autofocus>
        <button type="submit" name="cari">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
      <a class="tambah" href="tambah.php">Tambah</a>
    </div>
    <div class="data">
      <table>
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Deskripsi</th>
          <th>Harga</th>
          <th>Kategori</th>
          <th>Stok</th>
          <th></th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach($listProduk as $produk) : ?>
        <tr>
          <td><?= $i ?></td>
          <td> <img src="img/<?= $produk["gambar"] ?>" alt="<?= $produk["nama_produk"] ?>"></td>
          <td><?= $produk["nama_produk"] ?></td>
          <td style="width: 40%; text-align: justify;"><?= $produk["deskripsi"] ?></td>
          <td>Rp <?= number_format($produk["harga"], 0, ',', '.') ?></td>
          <td><?= $produk["nama_kategori"] ?></td>
          <td><?= $produk["stok"] ?></td>
          <td>
            <a class="hapus" href="hapus.php?id=<?= $produk["id_produk"] ?>"><i class="fa-solid fa-trash"></i></a>
            <a class="edit" href="edit.php?id=<?= $produk["id_produk"] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
          </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach ?>
      </table>
      <table class="kategori">
        <tr>
          <th>No</th>
          <th>Kategori</th>
          <th></th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach($listKategori as $kategori) : ?>
        <tr>
          <td><?= $i ?></td>
          <td><?= $kategori["nama_kategori"] ?></td>
          <td>
            <a class="hapus" href="hapus.php?id=<?= $kategori["id_kategori"] ?>"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach ?>
      </table>
    </div>
  </main>
</body>
</html>