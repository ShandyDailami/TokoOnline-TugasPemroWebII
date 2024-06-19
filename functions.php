<?php
  $hostname = 'localhost';
  $username = 'root';
  $password = 'root';
  $dbName = 'shop';

  $conn = mysqli_connect($hostname, $username, $password, $dbName);
  function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  }
  function cari($keyword) {
    $query = "SELECT produk.id_produk, produk.deskripsi, produk.nama_produk, produk.harga, kategori.nama_kategori, produk.stok, produk.gambar 
    FROM produk 
    INNER JOIN kategori 
    ON produk.kategori_id = kategori.id_kategori
    WHERE
    nama_produk LIKE '%$keyword%' OR
    nama_kategori LIKE '%$keyword%'";
    return query($query);
  };
  function cariPesanan($keyword) {
    $query = "SELECT pesanan.id_pesanan, kategori.nama_kategori, user.username, produk.nama_produk, produk.harga, produk.stok, produk.gambar, pesanan.jumlah_pesanan 
    FROM pesanan 
    JOIN user ON pesanan.user_id = user.id_user 
    JOIN produk ON pesanan.produk_id = produk.id_produk 
    JOIN kategori ON produk.kategori_id = kategori.id_kategori
    WHERE
    nama_produk LIKE '%$keyword%' OR
    nama_kategori LIKE '%$keyword%'";
    return query($query);
  }
  function register($data) {
    global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);

  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  if(mysqli_fetch_assoc($result)) {
    echo"<script>
      alert('username sudah terdaftar')
    </script>";
    return false;
  }

  $password = password_hash($password, PASSWORD_DEFAULT);

  mysqli_query($conn, "INSERT INTO user VALUE (null, '$password', '$username')");
  return mysqli_affected_rows($conn);
  }
  function tambahKategori($data) {
    global $conn;
    $kategori = htmlspecialchars($data["kategori"]);

    $query = "INSERT INTO kategori
    VALUES (null, '$kategori')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }
  function tambahProduk($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $stok = htmlspecialchars($data["stok"]);
    $gambar = upload();
      if(!$gambar) {
    return false;
    }
    $query = "INSERT INTO produk VALUES
    (null, '$nama', '$harga', $kategori, '$stok', '$gambar', '$deskripsi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }
  function tambahPesanan($data) {
    global $conn;
    $user_id = htmlspecialchars($data["user"]);
    $produk_id = htmlspecialchars($data["produk"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $query = "INSERT INTO pesanan VALUES
    (null, $user_id, $produk_id, '$jumlah')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }
  function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4) {
      echo"<script>
        alert('pilih gambar terlebih dahulu')
      </script>";
      return false;
    }
    $ekstensiGambarValid = ['jpg' , 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo"<script>
        alert('yang anda upload bukan gambar')
      </script>";
      return false;
    }

    if($ukuranFile > 1000000) {
      echo"<script>
        alert('ukuran gambar terlalu besar')
      </script>";
      return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
  }
  function hapusKategori($id) {
    global $conn; 
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");
    return mysqli_affected_rows($conn);
  }
  function hapusProduk($id) {
    global $conn; 
    mysqli_query($conn, "DELETE FROM produk 
    WHERE id_produk = $id");
    return mysqli_affected_rows($conn);
  }
  function edit($data) {
    global $conn;
    $id = htmlspecialchars($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $stok = htmlspecialchars($data["stok"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    if($_FILES["gambar"]["error"] === 4) {
      $gambar = $gambarLama;
    } else {
      $gambar = upload();
    }
  
    $query = "UPDATE produk SET
              nama_produk = '$nama',
              harga = '$harga',
              kategori_id = $kategori,
              stok = '$stok',
              gambar = '$gambar',
              deskripsi = '$deskripsi'
              WHERE id_produk = $id";
    mysqli_query($conn, $query);
  
    return mysqli_affected_rows($conn);
  }
  function getJsonProduk() {
    // global $conn;
    // $query = "SELECT * FROM produk";
    // $result = mysqli_query($conn, $query);
    // $data = [];
    // while($row = $result->fetch_assoc()) {
    //   $data[] = $row;
    // }
    // $json_data = json_encode($data);
    // header('Content-Type: application/json');
    // echo $json_data;
    if(isset($_GET["id"])) {
      $id = $_GET["id"];
      $query = "SELECT * FROM produk WHERE id_produk = $id";
    } elseif(!isset($_GET["id"])) {
      $query = "SELECT * FROM produk";
    }
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($rows);  
  }

  function getCat() {
      $url = "https://cataas.com/api/cats?tags=cute";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $url);
      $result = curl_exec($ch);
      curl_close($ch);
      $json_data = json_decode($result, true);
  
      if (is_array($json_data) && !empty($json_data)) {
          echo '<table border="1">
                  <tr>
                      <th>Gambar</th>
                  </tr>';
  
          foreach ($json_data as $cat) {
              $imgUrl = "https://cataas.com/cat/" . $cat['_id'];
              echo '<tr>
                      <td><img style="width: 50px" src="' . htmlspecialchars($imgUrl) . '" alt="Cat Image"></td>
                    </tr>';
          }
  
          echo '</table>';
      } else {
          echo 'No cat images found.';
      }
  }