<?php
  require 'functions.php';
  $listPesanan = query("SELECT pesanan.id_pesanan, kategori.nama_kategori, user.username, produk.nama_produk, produk.harga, produk.stok, produk.gambar, pesanan.jumlah_pesanan FROM pesanan JOIN user ON pesanan.user_id = user.id_user JOIN produk ON pesanan.produk_id = produk.id_produk JOIN kategori ON produk.kategori_id = kategori.id_kategori");
  if(isset($_POST["cari"])) {
    $listPesanan = cariPesanan($_POST["key"]);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Beranda</title>
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
    nav input {
      width: 300px;
      height: 31px;
      padding-left: 15px;
      border: 1px solid rgba(0, 0, 0, 0.308);;
      border-radius: 2px;
      outline: none;
    }
    nav button {
      height: 32px;
      width: 32px;
      color: white;
      border-radius: 2px;
      border: none;
      background-color: rgb(90, 128, 255);
      cursor: pointer;
      transition: .2s;
    }
    nav button:hover {
      background-color: #5276eb;
    }
    .user a {
      color: black;
    }
    main {
      display: flex;
    }
    aside {
      width: 25%;
      height: 100vh;
      padding: 5px;
      border-radius: 0 5px 0 0;
      background-color: rgb(216, 216, 216);
    }
    aside ul li {
      display: flex;
      align-items: center;
      margin-bottom: 5px;
      width: 100%;
      height: 50px;
      border-radius: 3px;
    }
    aside ul li .pick {
      display: flex;
      align-items: center;
      border-radius: 3px;
      background-color: white;
    }
    aside ul li .unpick {
      display: flex;
      align-items: center;
    }
    aside ul li:hover {
      background-color: white;
    }
    aside ul li a {
      display: inline-block;
      width: 100%;
      height: 50px;
      color: black;
      padding-left: 7px;
      font-weight: 600;
    }
    aside ul li a i {
      margin-right: 5px;
      font-size: 1.4rem;
    }
    section {
      display: flex;
      align-items: start;
      width: 75%;
      padding: 0 5px;
    }
    .card-wrapper {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .card {
      display: flex;
      height: 100px;
      width: 100%;
      justify-content: center;
      align-items: center;
      gap: 10px;
      border-bottom: 1px solid #dddddd;
    }
    .card img {
      width: 100px;
      height: 100px;
    }
    .card h1 {
      font-size: 1rem;
    }
    .card .wrap {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
    }
    .card .desk {
      display: flex;
      flex-direction: column;
      width: 300px;
      gap: 10px;
    }
    .card header {
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }
  </style>
</head>
<body>
  <nav>
    <h1>SHOP</h1>
    <form action="" method="post">
      <input type="text" name="key" id="key" placeholder="serach" autofocus>
      <button type="submit" name="cari">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </form>
    <div class="user">
      <a href="admin.php">
        <span>Admin</span>
      </a>
    </div>
  </nav>
  <main>
    <aside>
      <ul>
        <li><a href="home.php" class="unpick"><i class="fa-solid fa-house"></i>Beranda</a></li>
        <li><a href="pesanan.php" class="pick"><i class="fa-solid fa-cart-shopping"></i>Pesanan</a></li>
      </ul>
    </aside>
    <section>
      <div class="card-wrapper">
        <?php foreach($listPesanan as $pesanan) : ?>
          <div class="card">
            <img src="img/<?= $pesanan["gambar"] ?>" alt="">
            <div class="desk">
              <header>
                <h1><?= $pesanan["nama_produk"] ?></h1>
                <p><?= $pesanan["username"] ?></p>
              </header>
              <div class="wrap">
                <p><?= $pesanan["nama_kategori"] ?></p>
                <p><?= $pesanan["jumlah_pesanan"] ?> buah</p>
              </div>
              <div class="wrap">
                <p>Rp <?= number_format($pesanan["harga"], 2, ',', '.') ?></p>
                <p>Stok <?= $pesanan["stok"] ?></p>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </section>
  </main>
</body>
</html>