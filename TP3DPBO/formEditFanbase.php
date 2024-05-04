<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Fanbase.php');
include('classes/Template.php');

$fanbase = new Fanbase($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$fanbase->open();        

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    if ($id > 0) {
        $fanbase->getFanbaseById($id);
        $fanbaseData = $fanbase->getResult();

        
        $nama_fanbase = $fanbaseData['nama_fanbase'];
    } 
}

$view = new Template('templates/skinform.html');

$mainTitle = 'fanbase';
$title = 'Ubah';  

$data = '
<form action="formEditfanbase.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
    <div class="formbold-input">
        <div>
            <label for="nama_fanbase" class="formbold-form-label"> Nama Fanbase </label>
            <input type="text" name="nama_fanbase" id="nama_fanbase" placeholder="Masukkan fanbase" class="formbold-form-input" value="' . $nama_fanbase . '" required/>
        </div>
    </div></br>
    <button class="formbold-btn" type="submit" name="submit">
        SIMPAN
    </button>
</form>';

if (isset($_POST['submit'])) {
    if ($fanbase->updateFanbase($id, $_POST, $_FILES) > 0) {
        echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'fanbase.php';
    </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah!');
        document.location.href = 'fanbase.php';
    </script>";
    }
}

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_ADD', $data);

$view->write();

?>
