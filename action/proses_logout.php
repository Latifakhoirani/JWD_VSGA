<?php
session_Start();
session_destroy();
header("location:../index.php?pesan=anda berhasil logout.");
?>