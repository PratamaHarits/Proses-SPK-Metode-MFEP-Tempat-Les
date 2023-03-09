<?php
// koneksi
$conn = mysqli_connect("localhost", "root", "", "db_mfep");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | MFEP</title>

    <!-- CSS BOOTSTRAP-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- MY CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form>
        <fieldset disabled>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Jurnal :</label>
                <div class="col-sm-11">
                    <input type="email" class="form-control" id="disabledTextInput" placeholder="Sistem Pendukung Keputusan Dalam Merekomendasikan Tempat Les Musik Dipematangsiantar Menggunakan Metode Multifactor Evaluation Process (MFEP)">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Penulis :</label>
                <div class="col-sm-11">
                    <input type="email" class="form-control" id="disabledTextInput" placeholder="Theresia Siburian, Rafiqa Dewi, Widodo">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Publisher :</label>
                <div class="col-sm-11">
                    <input type="email" class="form-control" id="disabledTextInput" placeholder="KOMIK (Konferensi Nasional Teknologi Informasi dan Komputer)">
                </div>
            </div>
        </fieldset>
    </form>
    <hr>

    <h3 class="text-center">Rekomendasi Tempat Les Musik di Kota Pematangsiantar</h3>
    <hr>

    <!-- array ranks untuk menampung hasil perangkingan -->
    <?php $ranks = array(); ?>

    <!-- Tabel alternatif -->
    <p class="text-center fw-bold">Tabel Alternatif</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th>No</th>
                <th>Kode Alternatif</th>
                <th>Nama Alternatif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_alternatif");
            $no = 1;
            while ($alternatif = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $alternatif['alternatif_kode'] ?></td>
                    <td><?= $alternatif['alternatif_nama'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- Tabel kriteria -->
    <p class="text-center fw-bold">Tabel Kriteria</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th>No</th>
                <th>Kode Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Bobot Kriteria</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_kriteria");
            $no = 1;
            while ($kriteria = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $kriteria['kriteria_kode'] ?></td>
                    <td><?= $kriteria['kriteria_nama'] ?></td>
                    <td><?= $kriteria['kriteria_bobot'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- Tabel pemfaktoran -->
    <p class="text-center fw-bold">Tabel Pemfaktoran</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th rowspan="2">No</th>
                <th rowspan="2">
                    Nama Alternatif
                </th>
                <!-- jumlah data kriteria -->
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                $kriteriaRows = mysqli_num_rows($data);
                ?>
                <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>
            </tr>
            <tr class="table-info">
                <!-- nama kriteria -->
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                while ($kriteria = $data->fetch_assoc()) { ?>
                    <td><?= $kriteria['kriteria_nama']; ?></td>
                <?php } ?>
            </tr>

        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
            $no = 1;
            while ($alternatif = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $alternatif['alternatif_nama'] ?></td>
                    <!-- ambil nilai_faktor berdasarkan alternatif_kode dan kriteria_kode -->
                    <?php
                    $alt_kode = $alternatif['alternatif_kode'];
                    $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alt_kode' ORDER BY kriteria_kode");
                    while ($data_nilai = $sql->fetch_assoc()) { ?>
                        <td><?= $data_nilai['nilai_faktor']; ?></td>
                    <?php } ?>
                <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- Tabel weight evalution -->
    <p class="text-center fw-bold">Tabel Nilai Weight Evaluation</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Alternatif</th>
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                $kriteriaRows = mysqli_num_rows($data);
                ?>
                <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>
                <th rowspan="2">Hasil Penilaian</th>

            </tr>
            <tr class="table-info">
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                while ($kriteria = $data->fetch_assoc()) { ?>
                    <td><?= $kriteria['kriteria_nama']; ?></td>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
            $no = 1;
            while ($alternatif = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $alternatif['alternatif_nama'] ?></td>
                    <?php $hasilSum = 0; ?>
                    <?php
                    $alternatifKode = $alternatif['alternatif_kode'];
                    $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alternatifKode' ORDER BY kriteria_kode");
                    while ($data_nilai = $sql->fetch_assoc()) { ?>

                        <?php
                        $kriteriaKode = $data_nilai['kriteria_kode'];
                        $sqli = $conn->query("SELECT * FROM ta_kriteria WHERE kriteria_kode='$kriteriaKode' ORDER BY kriteria_kode");
                        while ($kriteria = $sqli->fetch_assoc()) { ?>

                            <?php
                            $bobot = $conn->query("SELECT * FROM ta_kriteria WHERE kriteria_kode='$kriteriaKode' ORDER BY kriteria_kode");
                            $kriteria_bobot = $bobot->fetch_assoc();
                            ?>

                            <?php

                            $hasil = $kriteria_bobot['kriteria_bobot'] * $data_nilai['nilai_faktor'];

                            $hasilSum = $hasilSum + $hasil;
                            ?>

                            <td><?= $hasil; ?></td>
                        <?php } ?>
                    <?php } ?>

                    <td><?= $hasilSum; ?></td>

                    <?php
                    $rank['hasilSum'] = $hasilSum;
                    $rank['alternatifNama'] = $alternatif['alternatif_nama'];
                    $rank['alternatifKode'] = $alternatif['alternatif_kode'];
                    array_push($ranks, $rank);
                    ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>

    <!-- Tabel perangkingan -->
    <p class="text-center fw-bold">Tabel Perangkingan</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-warning">
                <th>Ranking</th>
                <th>Kode Alternatif</th>
                <th>Nama Alternatif</th>
                <th>Nilai MFEP</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            rsort($ranks);
            foreach ($ranks as $r) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $r['alternatifKode']; ?></td>
                    <td><?= $r['alternatifNama']; ?></td>
                    <td><?= $r['hasilSum']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <!-- JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>