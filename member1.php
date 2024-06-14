<div class="modal fade" id="member1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Bagian Tentang Kami</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <?php
                    include "action/koneksi.php";
                    $member1 = "SELECT * FROM pelanggan WHERE id=1";
                    $result = mysqli_query($koneksi, $member1);
                    if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    }
                    $member11 = mysqli_fetch_assoc($result);
                    ?>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $member11['nama']; ?>">
                        </div>
                        <div class="col">
                            <label class="form-label">Asal</label>
                            <input type="text" class="form-control" name="asal" value="<?php echo $member11['asal']; ?>">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-success" value="Update">
            </div>
            </form>
        </div>
    </div>
</div>

<?php
include "action/koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $asal = mysqli_real_escape_string($koneksi, $_POST['asal']);

    $query = "UPDATE pelanggan SET 
                nama='$nama',
                asal='$asal' 
              WHERE id=1";

    if (mysqli_query($koneksi, $query)) {
        header("Location: admin.php?message=update_success");
        
        exit(); 
    } else {
        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
}
?>
