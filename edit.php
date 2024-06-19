<?php
  require 'functions.php';
  $id = $_GET["id"];
  $produk = query("SELECT produk.id_produk, produk.nama_produk, produk.harga, kategori.id_kategori, kategori.nama_kategori, produk.stok, produk.gambar, produk.deskripsi
  FROM produk 
  INNER JOIN kategori 
  ON produk.kategori_id = kategori.id_kategori
  WHERE id_produk = $id")[0];
  if(isset($_POST["submit"])) {
    if(edit($_POST) > 0) {
      echo "<script>
      alert('data berhasil diubah')
      document.location.href = 'admin.php'
        </script>";
      } else {
        echo "<script>
        alert('data gagal diubah')
        document.location.href = 'admin.php'
    </script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Edit</title>
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
    main {
      padding: 20px 0;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: start;
      gap: 20px;
      background-color: #ddd;
    }
    form {
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      border: 1px solid rgba(0, 0, 0, 0.308);
      border-radius: 5px;
      background-color: white;
    }
    form input[type=text], form select, form input[type=file] {
      margin-bottom: 10px;
      width: 500px;
      height: 50px;
      padding-left: 15px;
      border: 1px solid rgba(0, 0, 0, 0.308);
      border-radius: 3px;
      outline: none;
    }
    form select {
      width: 517px;
    }
    form input[type=file] {
      padding-left: 0;
      border: none;
    }
    form label {
      font-size: 1.5rem;
      font-weight: 600;
    }
    form textarea {
      height: 90px;
      margin-bottom: 10px;
      padding: 10px 0 0 15px;
      border: 1px solid rgba(0, 0, 0, 0.308);
      border-radius: 3px;
      outline: none;
      resize: none;
    }
    form button {
      padding: 14px 0;
      color: white;
      font-weight: 600;
      border-radius: 3px;
      background-color: #0d6efd;
      transition: .2s;
      border: none;
    }
    form button:hover {
      background-color: #0c66eb;
    }
    img {
      width: 50px;
      height: 50px;
    }
    a {
      color: black;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <nav>
    <h1>Edit Produk</h1>
    <a class="back" href="admin.php">back</a>
  </nav>
  <main>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $produk["id_produk"] ?>">
    <input type="hidden" name="gambarLama" value="<?= $produk["gambar"] ?>">
      <label for="nama">Nama Produk</label>
      <input type="text" name="nama" id="nama" placeholder="Nama Produk" value="<?= $produk["nama_produk"] ?>">
      <label for="harga">Harga Produk</label>
      <input type="text" name="harga" id="harga" placeholder="Harga Produk" value="<?= $produk["harga"] ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategoriProduk">
        <option disabled>Pilih Kategori</option>
        <option value="<?= $produk["id_kategori"] ?>"><?= $produk["nama_kategori"] ?></option>
      </select>
      <label for="stok">Stok Produk</label>
      <input type="text" name="stok" id="stok" placeholder="Stok Produk" value="<?= $produk["stok"] ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
      <label for="deskripsi">Deskripi Produk</label>
      <textarea type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi Produk"><?= $produk["deskripsi"] ?></textarea>
      <label for="gambar">Gambar Produk</label>
      <img src="img/<?= $produk["gambar"] ?>" alt="">
      <input type="file" name="gambar" id="gambar" >
      <button type="submit" name="submit">Submit</button>
    </form>
  </main>
</body>
</html>