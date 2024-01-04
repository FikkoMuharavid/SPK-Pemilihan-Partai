<!doctype html>
<html lang="en">

<?php
include 'components/head.php';
?>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <?php
    include 'components/sidebar.php';
    ?>

    <!-- Isi Halaman  -->
    <div id="content" class="p-5 p-md-5">

      <?php
      include 'components/navbar.php';
      ?>

      <section id="main-content">
        <section class="wrapper">

          <!--Koneksi Database-->
          <?php
          include 'koneksi.php';

          if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $pengembang = $_POST['pengembang'];
            if (($nama == "") or ($pengembang == "")) {
              echo "<script>alert('Tolong Lengkapi Data yang Ada!');</script>";
            } else {
              $sql = "SELECT * FROM saw_aplikasi WHERE nama='$nama'";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;
              if ($rows > 0) {
                $row = $hasil->fetch_row();
                echo "<script>alert('Aplikasi $nama Sudah Ada!');</script>";
              } else {
                $sql = "INSERT INTO saw_aplikasi(nama,pengembang)
                values ('" . $nama . "','" . $pengembang . "')";
                $hasil = $conn->query($sql);
                echo "<script>alert('Data Barhasil diTambahkan!');</script>";
              }
            }
          }
          ?>
          <!-- END SCRIPT INSERT-->

          <!--start inputan-->
          <form method="POST" action="">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Partai</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="nama" autocomplete="off">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kepanjangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="pengembang" autocomplete="off">
              </div>
            </div>
            <div class="mb-4">
              <button type="submit" name="submit" class="btn btn-outline-dark"><i class="fa fa-save"></i> Submit</button>
            </div>
          </form>
          <table class="table table-striped table-hove">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama  Partai</th>
                <th>Kepanjangan</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $b = 0;
              $sql = "SELECT*FROM saw_aplikasi ORDER BY nama ASC";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;
              if ($rows > 0) {
                while ($row = $hasil->fetch_row()) {
              ?>
                  <tr>
                    <td>&nbsp;<?php echo $b = $b + 1; ?></td>
                    <td><?= $row[0] ?></td>
                    <td><?= $row[1] ?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-outline-info" href="alt_ubah.php?nama=<?= $row[0] ?>"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-outline-danger" href="alt_hapus.php?nama=<?= $row[0] ?>"><i class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
              <?php }
              } else {
                echo "<tr>
                    <td>Data Tidak Ada</td>
                <tr>";
              } ?>
            </tbody>
          </table>
        </section>
      </section>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>