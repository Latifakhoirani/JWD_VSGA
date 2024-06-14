<?php
include 'koneksi.php';

if (isset($_POST['nama']) && isset($_FILES['foto'])) {
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $harga = $koneksi->real_escape_string($_POST['harga']);
    $keterangan = $koneksi->real_escape_string($_POST['keterangan']);
    $fileName = $_FILES['foto']['name'];
    $fileTmpName = $_FILES['foto']['tmp_name'];
    $fileSize = $_FILES['foto']['size'];
    $fileError = $_FILES['foto']['error'];
    $fileType = $_FILES['foto']['type'];

    // Mendapatkan ekstensi file dengan cara yang lebih aman
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) { // Batas ukuran file (dalam byte)
                $fileNewName = uniqid('', true) . "." . $fileExt;
                $fileDestination = '../img/' . $fileNewName;
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Menggunakan prepared statement untuk menghindari SQL Injection
                    $stmt = $koneksi->prepare("INSERT INTO menu (nama, harga, keterangan, foto) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param('siss', $nama, $harga, $keterangan, $fileNewName);
                    if ($stmt->execute()) {
                        echo "<script>alert('Data berhasil disimpan!');window.location='../admin.php';</script>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Error saat mengunggah file.";
                }
            } else {
                echo "Ukuran file terlalu besar.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Jenis file tidak diizinkan.";
    }
} else {
    echo "<script>alert('Data tidak lengkap!');window.location='../../portofolio.php';</script>";
}
?>
