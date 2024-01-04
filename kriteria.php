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
    <div id="content" class="pl-3 p-md-5">

      <?php
      include 'components/navbar.php';
      ?>

      <section id="main-content">
        <section class="wrapper">


          <!--START SCRIPT HITUNG-->
          <script>
            function fungsiku() {
              var a = (document.getElementById("peringkat_param").value).substring(0, 1);
              var b = (document.getElementById("ukuran_param").value).substring(0, 1);
              var c = (document.getElementById("unduhan_param").value).substring(0, 1);
              var d = (document.getElementById("aktif_param").value).substring(0, 1);
              var total = Number(a) + Number(b) + Number(c) + Number(d);
              document.getElementById("peringkat").value = (Number(a) / total).toFixed(2);
              document.getElementById("ukuran").value = (Number(b) / total).toFixed(2);
              document.getElementById("unduhan").value = (Number(c) / total).toFixed(2);
              document.getElementById("aktif").value = (Number(d) / total).toFixed(2);
            }
          </script>
          <!--END SCRIPT HITUNG-->


          <!--START SCRIPT INSERT-->
          <?php

          include 'koneksi.php';

          if (isset($_POST['submit'])) {
            $peringkat = $_POST['peringkat'];
            $ukuran = $_POST['ukuran'];
            $unduhan = $_POST['unduhan'];
            $aktif = $_POST['aktif'];
            if (($peringkat == "") or
              ($ukuran == "") or
              ($unduhan == "") or
              ($aktif == "") 
            ) {
              echo "<script>
              alert('Tolong Lengkapi Data yang Ada!');
              </script>";
            } else {
              $sql = "SELECT * FROM saw_kriteria";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;
              if ($rows > 0) {
                echo "<script>
                alert('Hapus Bobot Lama untuk Membuat Bobot Baru');
                </script>";
              } else {
                $sql = "INSERT INTO saw_kriteria(
                  peringkat,ukuran,unduhan,aktif)
                  values ('" . $peringkat . "',
                  '" . $ukuran . "',
                  '" . $unduhan . "',
                  '" . $aktif . "')";
                $hasil = $conn->query($sql);
                echo "<script>
                alert('Bobot Berhasil di Inputkan!');
                </script>";
              }
            }
          }
          ?>
          <!-- END SCRIPT INSERT-->


          <!--start inputan-->
          <form class="form-validate form-horizontal" id="register_form" method="post" action="">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label"><b>Kriteria</b></label>
              <div class="col-sm-3">
                <label><b>Bobot</b></label>
              </div>
              <div class="col-sm-2">
                <label><b>Perbaikan Bobot</b></label>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Umur Partai</label>
              <div class="col-sm-3">
                <select class="form-control" name="peringkat_param" id="peringkat_param">
                  <option>1. Sangat Rendah</option>
                  <option>2. Rendah</option>
                  <option>3. Cukup</option>
                  <option>4. Tinggi</option>
                  <option>5. Sangat Tinggi</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="peringkat" id="peringkat">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jumlah Kasus</label>
              <div class="col-sm-3">
                <select class="form-control" name="ukuran_param" id="ukuran_param">
                  <option>1. Sangat Rendah</option>
                  <option>2. Rendah</option>
                  <option>3. Cukup</option>
                  <option>4. Tinggi</option>
                  <option>5. Sangat Tinggi</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="ukuran" id="ukuran">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Total Suap</label>
              <div class="col-sm-3">
                <select class="form-control" name="unduhan_param" id="unduhan_param">
                  <option>1. Sangat Rendah</option>
                  <option>2. Rendah</option>
                  <option>3. Cukup</option>
                  <option>4. Tinggi</option>
                  <option>5. Sangat Tinggi</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="unduhan" id="unduhan">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Narapidana Dicalonkan</label>
              <div class="col-sm-3">
                <select class="form-control" name="aktif_param" id="aktif_param">
                  <option>1. Sangat Rendah</option>
                  <option>2. Rendah</option>
                  <option>3. Cukup</option>
                  <option>4. Tinggi</option>
                  <option>5. Sangat Tinggi</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="aktif" id="aktif">
              </div>
              <div class="col-sm-2">
                <button class="btn btn-outline-dark" type="button" id="hitung" onclick="fungsiku()" name="hitung"><i class="fa fa-calculator"></i> Hitung</button>
              </div>
            </div>
            <div class="mb-4">
              <button class="btn btn-outline-dark" type="submit" name="submit"><i class="fa fa-save"></i> Submit</button>
            </div>
          </form>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Umur Partai</th>
                <th>Jumlah Kasus</th>
                <th>Total Suap</th>
                <th>Narapidana Dicalonkan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <?php
            $b = 0;
            $sql = "SELECT * FROM saw_kriteria";
            $hasil = $conn->query($sql);
            $rows = $hasil->num_rows;
            if ($rows > 0) {
              while ($row = $hasil->fetch_row()) {
            ?>
                <tr>
                  <td><?= $row[1] ?></td>
                  <td><?= $row[2] ?></td>
                  <td><?= $row[3] ?></td>
                  <td ><?= $row[4] ?></td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-outline-danger" href="kriteria_hapus.php?id=<?= $row[0] ?>"><i class="fa fa-close"></i></a>
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