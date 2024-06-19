<?php
  require "functions.php";
  $id = $_GET["id"];
  $produk = query("SELECT produk.id_produk, produk.nama_produk, produk.harga, kategori.id_kategori, kategori.nama_kategori, produk.stok, produk.gambar, produk.deskripsi
  FROM produk 
  INNER JOIN kategori 
  ON produk.kategori_id = kategori.id_kategori
  WHERE id_produk = $id")[0];
  $user = query("SELECT id_user FROM user")[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Detail Produk</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    nav {
      padding: 0 20px;
      height: 70px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid rgba(150, 150, 150, 1);
    }
    nav .back {
      color: black;
      text-decoration: underline;
    }
    img {
      width: 400px;
    }
    .wrapper {
      display: flex;
      padding: 20px;
      width: 70%;
      align-items: center;
      gap: 10px;
    }
    .desk {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .wrap {
      display: flex;
      justify-content: space-between;
    }
    .deskripsi {
      text-align: justify;
    }
    form input[type=text] {
      width: 200px;
      height: 40px;
      padding-left: 15px;
      border: 1px solid rgba(0, 0, 0, 0.308);
      border-radius: 2px;
      outline: none;
    }
    form button {
      padding: 11px 24px;
      color: white;
      background-color: #0d6efd;
      border-radius: 2px;
      border: none;
      transition: .2s;
      cursor: pointer;
    }
    form button:hover {
      background-color: #0c66eb;
    }
  </style>
</head>
<body>
  <nav>
    <h1>Detail Produk</h1>
    <a class="back" href="home.php">back</a>
  </nav>
  <main>
    <div class="wrapper">
      <img src="img/<?= $produk["gambar"] ?>" alt="">
      <div class="desk">
        <h1><?= $produk["nama_produk"] ?></h1>
        <p class="deskripsi"><?= $produk["deskripsi"] ?></p>
        <p>Kategori: <?= $produk["nama_kategori"] ?></p>
        <div class="wrap">
          <p>Rp <?= number_format($produk["harga"], 2, ',', '.') ?></p>
          <p>Terjual <?= $produk["stok"] ?></p>
        </div>
        <form action="tambahPesanan.php" method="post">
          <input type="hidden" name="produk" value="<?= $produk["id_produk"] ?>">
          <input type="hidden" name="user" value="4">
          <input type="text" name="jumlah" placeholder="Jumlah Pesanan" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
          <button name="pesan" type="submit">Pesan</button>
        </form>
      </div>
    </div>
  </main>
</body>
</html>