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

                    <div>
                        <b><br>
                            <h6><b>MATRIX X</b></h6>
                        </b>
                        <table class="table table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Alternatif</th>
                                    <th>Umur Partai</th>
                                    <th>Jumlah Kasus</th>
                                    <th>Total Suap</th>
                                    <th>Narapidana Dicalonkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                include 'koneksi.php';

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
                                        </tr>
                                <?php }
                                } else {
                                    echo "<tr>
                                        <td>Data Tidak Ada</td>
                                    <tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <b><br><br><br>
                            <h6><b>NORMALISASI</b></h6>
                        </b>
                        <table class="table table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Alternatif</th>
                                    <th>Umur Partai</th>
                                    <th>Jumlah Kasus</th>
                                    <th>Total Suap</th>
                                    <th>Narapidana Dicalonkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT*FROM saw_penilaian";
                                $hasil = $conn->query($sql);
                                $rows = $hasil->num_rows;
                                if ($rows > 0) {
                                    $b = 0;
                                    $C1 = '';
                                    $C2 = '';
                                    $C3 = '';
                                    $C4 = '';

                                    $sql = "SELECT*FROM saw_penilaian ORDER BY peringkat DESC";
                                    $hasil = $conn->query($sql);
                                    $row = $hasil->fetch_row();
                                    $C1 = $row[1];
                                    // Biaya
                                    $sql = "SELECT*FROM saw_penilaian ORDER BY ukuran ASC";
                                    $hasil = $conn->query($sql);
                                    $row = $hasil->fetch_row();
                                    // End Biaya
                                    $C2 = $row[2];
                                    $sql = "SELECT*FROM saw_penilaian ORDER BY unduhan ASC";
                                    $hasil = $conn->query($sql);
                                    $row = $hasil->fetch_row();
                                    $C3 = $row[3];
                                    $sql = "SELECT*FROM saw_penilaian ORDER BY aktif ASC";
                                    $hasil = $conn->query($sql);
                                    $row = $hasil->fetch_row();
                                    $C4 = $row[4];
                                } else {
                                    echo "<tr>
                                        <td>Data Tidak Ada</td>
                                    <tr>";
                                }

                                $sql = "SELECT*FROM saw_penilaian";
                                $hasil = $conn->query($sql);
                                $rows = $hasil->num_rows;
                                if ($rows > 0) {
                                    while ($row = $hasil->fetch_row()) {
                                ?>
                                        <tr>
                                            <td>&nbsp<?php echo $b = $b + 1; ?></td>
                                            <td><?= $row[0] ?></td>
                                            <td><?= round($row[1] / $C1, 2) ?></td>
                                            <td><?= round($C2 / $row[2], 2) ?></td>
                                            <td><?= round($C3 / $row[3], 2) ?></td>
                                            <td><?= round($C4 / $row[4], 2) ?></td>
                                        </tr>
                                <?php }
                                }  ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <b><br><br><br>
                            <h6><b>NILAI PREFERENSI</b></h6>
                        </b>
                        <table class="table table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $b = 0;
                                $B1 = '';
                                $B2 = '';
                                $B3 = '';
                                $B4 = '';
                                $B5 = '';
                                $nilai = '';
                                $nama = '';
                                $x = 0;
                                $sql = "SELECT * FROM saw_kriteria";
                                $hasil = $conn->query($sql);
                                $rows = $hasil->num_rows;
                                if ($rows > 0) {
                                    $row = $hasil->fetch_row();
                                    $B1 = $row[1];
                                    $B2 = $row[2];
                                    $B3 = $row[3];
                                    $B4 = $row[4];
                                }
                                $sql = "TRUNCATE TABLE saw_perankingan";
                                $hasil = $conn->query($sql);

                                $sql = "SELECT * FROM saw_penilaian";
                                $hasil = $conn->query($sql);
                                $rows = $hasil->num_rows;
                                if ($rows > 0) {
                                    while ($row = $hasil->fetch_row()) {
                                        $nilai = round((($row[1] / $C1) * $B1) +
                                            (($C2 / $row[2]) * $B2) +
                                            (($C3 / $row[3]) * $B3) +
                                            (($C4 / $row[4]) * $B4), 3);
                                        $nama = $row[0];
                                        $sql1 = "INSERT INTO saw_perankingan(nama,nilai_akhir) VALUES ('" . $nama . "','" . $nilai . "')";
                                        $hasil1 = $conn->query($sql1);
                                    }
                                }
                                $sql = "SELECT * FROM saw_perankingan";
                                $hasil = $conn->query($sql);
                                $rows = $hasil->num_rows;
                                if ($rows > 0) {
                                    while ($row = $hasil->fetch_row()) {
                                ?>
                                        <tr>
                                            <td>&nbsp<?php echo $b = $b + 1; ?></td>
                                            <td><?= $row[1] ?></td>
                                            <td><?= $row[2] ?></td>
                                        </tr>
                                <?php }
                                } else {
                                    echo "<tr>
                                        <td>Data Tidak Ada</td>
                                    <tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <b><br><br><br>
                            <h6><b>PERANKINGAN</b></h6>
                        </b>
                        <table class="table table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $b = 0;
                                $sql = "SELECT*FROM saw_perankingan ORDER BY nilai_akhir DESC";
                                $hasil = $conn->query($sql);
                                if ($hasil->num_rows > 0) {
                                    while ($row = $hasil->fetch_row()) {
                                ?>
                                        <tr>
                                            <td>&nbsp<?php echo $b = $b + 1; ?></td>
                                            <td><?= $row[1] ?></td>
                                            <td><?= $row[2] ?></td>
                                        </tr>
                                <?php }
                                } else {
                                    echo "<tr>
                                        <td>Data Tidak Ada</td>
                                    <tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
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