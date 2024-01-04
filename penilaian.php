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

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

      <?php
      include 'components/navbar.php';
      ?>

      <section id="main-content">
        <section class="wrapper">

          <!--START SCRIPT INSERT-->
          <?php

          include 'koneksi.php';

          if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $peringkat = $_POST['peringkat'];
            $ukuran = $_POST['ukuran'];
            $unduhan = $_POST['unduhan'];
            $aktif = $_POST['aktif'];
            if ($peringkat == "" || $ukuran == "" || $unduhan == "" || $aktif == "") {
              echo "<script>
              alert('Tolong Lengkapi Data yang Ada!');
              </script>";
            } else {
              $sql = "SELECT*FROM saw_penilaian WHERE nama='$nama'";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;
              if ($rows > 0) {
                $row = $hasil->fetch_row();
                echo "<script>
                alert('Aplikasi $nama sudah ada!');
                </script>";
              } else {
                //insert name
                $sql = "INSERT INTO saw_penilaian(
                nama,peringkat,ukuran,unduhan,aktif)
                values ('" . $nama . "',
                '" . $peringkat . "',
                '" . $ukuran . "',
                '" . $unduhan . "',
                '" . $aktif . "')";
                $hasil = $conn->query($sql);
                echo "<script>
                alert('Penilaian Berhasil di Tambahkan!');
                </script>";
              }
            }
          }
          ?>
          <!-- END SCRIPT INSERT-->

          <!--start inputan-->
          <form method="POST" action="">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alternatif</label>
              <div class="col-sm-4">
                <select class="form-control" name="nama">
                  <?php
                  //load nama
                  $sql = "SELECT * FROM saw_aplikasi";
                  $hasil = $conn->query($sql);
                  $rows = $hasil->num_rows;
                  if ($rows > 0) {
                    while ($row = mysqli_fetch_array($hasil)) :; {
                      } ?> <option><?php echo $row[0]; ?></option>
                  <?php endwhile;
                  } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Umur Partai</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="peringkat" id="peringkat">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jumlah Kasus</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="ukuran">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Total Suap</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="unduhan">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Narapidana Dicalonkan</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="aktif">
              </div>
            </div>

            <div class="mb-4">
              <button type="submit" name="submit" class="btn btn-outline-dark"><i class="fa fa-save"></i> Submit</button>
            </div>
          </form>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Umur Partai</th>
                <th>Jumlah Kasus</th>
                <th>Total Suap</th>
                <th>Narapidana Dicalonkan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $b = 0;
              $sql = "SELECT*FROM saw_penilaian ORDER BY nama ASC";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;
              if ($rows > 0) {
                while ($row = $hasil->fetch_row()) {
              ?>
                  <tr>
                    <td>&nbsp<?php echo $b = $b + 1; ?></td>
                    <td><?= $row[0] ?></td>
                    <td><?= $row[1] ?></td>
                    <td><?= $row[2] ?></td>
                    <td><?= $row[3] ?></td>
                    <td><?= $row[4] ?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-outline-danger" href="penilaian_hapus.php?nama=<?= $row[0] ?>">
                          <i class="fa fa-close"></i></a>
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