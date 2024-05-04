<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Gen.php');

$generasi = new Generasi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$generasi->open();
$generasi->getGenerasi();

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'asc';
$generasi->getGenFiltered($filter);

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($generasi->addGenerasi($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'gen.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'gen.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}


$view = new Template('templates/skintabel.html');

$mainTitle = 'Generasi';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Generasi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'generasi';
$link = 'formAddGenerasi.php';

while ($div = $generasi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['gen'] . '</td>
    <td style="font-size: 22px;">
        <a href="formEditGenerasi.php?id=' . $div['id_gen'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="gen.php?hapus=' . $div['id_gen'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

$sortAbjad = null;
$sortAbjad .= 
    '<div class="dropdown text-end" style="position: absolute; top: 6px; right: 15px;">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Urutkan
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="gen.php?filter=asc">A-Z</a></li>
            <li><a class="dropdown-item" href="gen.php?filter=desc">Z-A</a></li>
        </ul>
    </div>';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($generasi->deleteGen($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'gen.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'gen.php';
            </script>";
        }
    }
}

$generasi->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_LINK', $link);
$view->replace('SORTING', $sortAbjad);

$view->write();
