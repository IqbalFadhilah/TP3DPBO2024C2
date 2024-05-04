<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Member.php');
include('classes/Template.php');

$member = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$member->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $member->getMemberById($id);
        $row = $member->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_member'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto_member'] . '" class="img-thumbnail" alt="' . $row['foto_member'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama_member'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>' . $row['tanggal_lahir'] . '</td>
                                </tr>
                                <tr>
                                    <td>Golongan Darah</td>
                                    <td>:</td>
                                    <td>' . $row['gol_darah'] . '</td>
                                </tr>
                                <tr>
                                    <td>Horoskop</td>
                                    <td>:</td>
                                    <td>' . $row['horoskop'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tinggi Badan</td>
                                    <td>:</td>
                                    <td>' . $row['tinggi_badan'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="formEditMember.php?id=' . $row['id_member'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['id_member'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($member->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$member->close();

$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_MEMBER', $data);
$detail->write();
