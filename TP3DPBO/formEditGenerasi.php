<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Gen.php');
include('classes/Template.php');

$generasi = new Generasi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$generasi->open();          

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    if ($id > 0) {
        $generasi->getGenerasiById($id);
        $generasiData = $generasi->getResult();

        $gen = $generasiData['gen'];
    } 
}

$view = new Template('templates/skinform.html');

$mainTitle = 'generasi';
$title = 'Ubah'; 

$data = '
<form action="formEditGenerasi.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
    <div class="formbold-input">
        <div>
            <label for="gen" class="formbold-form-label"> Generasi </label>
            <input type="text" name="gen" id="gen" placeholder="Masukkan generasi" class="formbold-form-input" value="' . $gen . '" required/>
        </div>
    </div></br>
    <button class="formbold-btn" type="submit" name="submit">
        SIMPAN
    </button>
</form>';

if (isset($_POST['submit'])) {
    if ($generasi->updateGen($id, $_POST, $_FILES) > 0) {
        echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'gen.php';
    </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah!');
        document.location.href = 'gen.php';
    </script>";
    }
}

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_ADD', $data);

$view->write();

?>
