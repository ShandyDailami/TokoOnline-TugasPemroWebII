<?php
  require 'functions.php';
  $listProduk = query("SELECT * FROM produk");
  if(isset($_POST["cari"])) {
    $listProduk = cari($_POST["key"]);
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
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }
    .card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-direction: column;
      width: 200px;
      height: 250px;
      padding: 10px;
      border: 1px solid rgba(150, 150, 150, 1);
      border-radius: 3px;
      cursor: pointer;
      transition: all .3s ease;
    }
    .card img {
      width: 100px;
      height: 100px;
    }
    .card:hover {
      transform: translate(0, -3px);
    }
    .card .bg {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 120px;
      background-color: rgba(0, 0, 0, .1);
      border-radius: 2px;
    }
    .card .desk {
      width: 100%;
      padding: 0 5px;
      display: flex;
      justify-content: space-between;
    }
    .card h1 {
      align-self: start;
      font-weight: 600;
      font-size: 1.3rem;
    }
    .card .desk p {
      font-weight: 400;
    }
    .card .desk span {
      font-size: .8rem;
      color: rgba(150, 150, 150, 1);
    }
    .pesan {
      color: black;
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
        <li><a href="home.php" class="pick"><i class="fa-solid fa-house"></i>Beranda</a></li>
        <li><a href="pesanan.php" class="unpick"><i class="fa-solid fa-cart-shopping"></i>Pesanan</a></li>
      </ul>
    </aside>
    <section>
      <div class="card-wrapper">
        <?php foreach($listProduk as $produk) : ?>
        <a class="pesan" href="item.php?id=<?= $produk["id_produk"] ?>">
          <div class="card">
            <div class="bg">
              <img src='img/<?=$produk["gambar"]?>' alt="<?= $produk["nama_produk"] ?>">
            </div>
            <h1><?= $produk["nama_produk"] ?></h1>
            <div class="desk">
              <p>Rp <?= number_format($produk["harga"], 0, ',', '.') ?></p>
              <span>tersisa <?= $produk["stok"] ?></span>
            </div>
          </div>
        </a>
        <?php endforeach ?>
      </div>
    </section>
  </main>
</body>
</html>