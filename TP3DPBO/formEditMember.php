<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Member.php');
include('classes/Gen.php');
include('classes/Fanbase.php');
include('classes/Template.php');

$member = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$member->open();          

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    if ($id > 0) {
        $member->getMemberById($id);
        $memberData = $member->getResult();

        $nama_member = $memberData['nama_member'];
        $tanggal_lahir = $memberData['tanggal_lahir'];
        $gol_darah = $memberData['gol_darah'];
        $horoskop = $memberData['horoskop'];
        $tinggi_badan = $memberData['tinggi_badan'];
        $foto_member = $memberData['foto_member'];
        $id_gen_selected = $memberData['id_gen']; 
        $id_fanbase_selected = $memberData['id_fanbase']; 
    } 
}

// Buat objek generasi
$generasi = new Generasi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$generasi->open();           
$generasi->getGenerasi();   

$pilihGenerasi = '';

while ($row = $generasi->getResult()) {
    $selected = ($row['id_gen'] == $id_gen_selected) ? 'selected' : ''; 
    $pilihGenerasi .= '<option value="' . $row['id_gen'] . '" ' . $selected . '>' . $row['gen'] . '</option>'; 
}

$generasi->close(); 

$fanbase = new Fanbase($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$fanbase->open();       
$fanbase->getFanbase(); 

$pilihFanbase = '';

while ($row = $fanbase->getResult()) {
    $selected = ($row['id_fanbase'] == $id_fanbase_selected) ? 'selected' : ''; 
    $pilihFanbase .= '<option value="' . $row['id_fanbase'] . '" ' . $selected . '>' . $row['nama_fanbase'] . '</option>'; 
}

$fanbase->close(); 

$view = new Template('templates/skinform.html');

$mainTitle = 'Member';
$title = 'Ubah';  

$data = '
<form action="formEditMember.php?id=' . $id . '" method="POST" enctype="multipart/form-data">
    <div class="formbold-input">
        <div>
            <label for="nama_member" class="formbold-form-label"> Nama Member </label>
            <input type="text" name="nama_member" id="nama_member" placeholder="Masukkan nama member" class="formbold-form-input" value="' . $nama_member . '" required/>
        </div>
    </div></br>
    <div class="formbold-input-flex">
        <div>
            <input type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan tanggal lahir" class="formbold-form-input" value="' . $tanggal_lahir . '" required/>
            <label for="tanggal_lahir" class="formbold-form-label"> Tanggal Lahir </label>
        </div>
        <div>
            <input type="text" name="gol_darah" id="gol_darah" placeholder="Masukkan golongan darah" class="formbold-form-input" value="' . $gol_darah . '" required/>
            <label for="gol_darah" class="formbold-form-label"> Golongan Darah </label>
        </div>
    </div>
    <div class="formbold-input-flex">
        <div>
            <input type="text" name="horoskop" id="horoskop" placeholder="Masukkan horoskop" class="formbold-form-input" value="' . $horoskop . '" required/>
            <label for="horoskop" class="formbold-form-label"> Horoskop </label>
        </div>
        <div>
            <input type="text" name="tinggi_badan" id="tinggi_badan" placeholder="Masukkan tinggi badan" class="formbold-form-input" value="' . $tinggi_badan . '" required/>
            <label for="tinggi_badan" class="formbold-form-label"> Tinggi Badan </label>
        </div>
    </div>
    <div class="formbold-input-flex">
        <div class="formbold-select-wrapper">
            <select class="formbold-select" id="id_gen" name="id_gen" required>
                <option selected disabled>Pilih Generasi</option>' . $pilihGenerasi . '
            </select>
            <label for="gen" class="formbold-form-label">Generasi</label>
        </div>
        <div class="formbold-select-wrapper">
            <select class="formbold-select" id="id_fanbase" name="id_fanbase" required>
                <option selected disabled>Pilih Fanbase</option>' . $pilihFanbase . '
            </select>
            <label for="fanbase" class="formbold-form-label">Fanbase</label>
        </div>
    </div>
    <div class="mb-3">
        <label for="foto_member" class="formbold-form-label">Foto Member</label>
        <img src="assets/images/' . $foto_member . '" alt="Foto Member" width="150px" height="211px"></br>
        <input type="file" class="form-control" id="foto_member" name="foto_member">
    </div>
    <button class="formbold-btn" type="submit" name="submit">
        SIMPAN
    </button>
</form>';

if (isset($_POST['submit'])) {
    if ($member->updateData($id, $_POST, $_FILES) > 0) {
        echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'index.php';
    </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah!');
        document.location.href = 'index.php';
    </script>";
    }
}

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_ADD', $data);

$view->write();

?>
