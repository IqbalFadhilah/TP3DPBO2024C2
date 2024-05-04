<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Template.php');
include('classes/Fanbase.php');

$fanbase = new Fanbase($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$fanbase->open();
$fanbase->getFanbase();


$filter = isset($_GET['filter']) ? $_GET['filter'] : 'asc';
$fanbase->getFanbaseFiltered($filter);

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($fanbase->addFanbase($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'fanbase.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'fanbase.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Fanbase';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Fanbase</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'fanbase';
$link = 'formAddFanbase.php';

while ($div = $fanbase->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_fanbase'] . '</td>
    <td style="font-size: 22px;">
        <a href="formEditFanbase.php?id=' . $div['id_fanbase'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="fanbase.php?hapus=' . $div['id_fanbase'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}


if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($fanbase->deleteFanbase($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'fanbase.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'fanbase.php';
            </script>";
        }
    }
}

$sortAbjad = null;
$sortAbjad .= 
    '<div class="dropdown text-end" style="position: absolute; top: 6px; right: 15px;">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Urutkan
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="fanbase.php?filter=asc">A-Z</a></li>
            <li><a class="dropdown-item" href="fanbase.php?filter=desc">Z-A</a></li>
        </ul>
    </div>';

$fanbase->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_LINK', $link);
$view->replace('SORTING', $sortAbjad);

$view->write();
