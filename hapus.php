<?php
require 'functions.php';

$id = $_GET["id"];

if(hapusKategori($id) > 0) {
  echo "<script>
  alert('kategori berhasil dihapus')
  document.location.href = 'admin.php'
  </script>";
} else {
    echo "<script>
    alert('kategori gagal dihapus')
      document.location.href = 'admin.php'
      </script>";
  }
  if(hapusProduk($id) > 0) {
    echo "<script>
      alert('data berhasil dihapus')
      document.location.href = 'admin.php'
      </script>";
  } else {
    echo "<script>
      alert('data gagal dihapus')
      document.location.href = 'admin.php'
      </script>";
  }