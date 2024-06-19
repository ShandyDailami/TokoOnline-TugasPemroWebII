<?php
  require "functions.php";
  if(isset($_POST["pesan"])) {
    if(tambahPesanan($_POST) > 0) {
      echo "<script>
        alert('data berhasil ditambah')
        document.location.href = 'home.php'
        </script>";
      } else {
        echo "<script>
        alert('data gagal ditambah')
        document.location.href = 'home.php'
      </script>";
    }
  }