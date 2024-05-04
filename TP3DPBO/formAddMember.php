<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Member.php');
include('classes/Gen.php');
include('classes/Fanbase.php');
include('classes/Template.php');

$member = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$member->open();         
$member->getMember();  

$generasi = new Generasi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$generasi->open();            
$generasi->getGenerasi();   
$pilihGenerasi = '';        
while ($row = $generasi->getResult()) {
    $pilihGenerasi .= '<option value="' . $row['id_gen'] . '">' . $row['gen'] . '</option>';
}

$generasi->close(); 

$fanbase = new Fanbase($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$fanbase->open();         
$fanbase->getFanbase(); 
$pilihFanbase = '';     
while ($row = $fanbase->getResult()) {
    $pilihFanbase .= '<option value="' . $row['id_fanbase'] . '">' . $row['nama_fanbase'] . '</option>'; 
}

$fanbase->close(); 

$view = new Template('templates/skinform.html');

$mainTitle = 'Member';

if (!isset($_GET['id'])) {  
    $title = 'Tambah';  

    $data = 
    '<form action="formAddMember.php" method="POST" enctype="multipart/form-data">
          <div class="formbold-input">
            <div>
                <label for="nama_member" class="formbold-form-label"> Nama Member </label>
                <input type="text" name="nama_member" id="nama_member" placeholder="Masukkan nama member" class="formbold-form-input" required/>
            </div>
          </div></br>
          <div class="formbold-input-flex">
            <div>
                <input type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan tanggal lahir" class="formbold-form-input" required/>
                <label for="tanggal_lahir" class="formbold-form-label"> Tanggal Lahir </label>
            </div>
            <div>
                <input type="text" name="gol_darah" id="gol_darah" placeholder="Masukkan golongan darah" class="formbold-form-input" required/>
                <label for="gol_darah" class="formbold-form-label"> Golongan Darah </label>
            </div>
          </div>
          <div class="formbold-input-flex">
              <div>
                <input type="text" name="horoskop" id="horoskop" placeholder="Masukkan horoskop" class="formbold-form-input" required/>
                <label for="horoskop" class="formbold-form-label"> Horoskop </label>
              </div>
              <div>
                <input type="text" name="tinggi_badan" id="tinggi_badan" placeholder="Masukkan tinggi badan" class="formbold-form-input" required/>
                <label for="tinggi_badan" class="formbold-form-label"> Tinggi Badan </label>
              </div>
          </div>
          <div class="formbold-input-flex">
            <div class="formbold-select-wrapper">
                <select class="formbold-select" id="id_gen" name="id_gen" required>
                    <option selected disabled>Pilih Generasi</option>
                    ' . $pilihGenerasi . '
                </select>
                <label for="gen" class="formbold-form-label">Generasi</label>
            </div>
            <div class="formbold-select-wrapper">
                <select class="formbold-select" id="id_fanbase" name="id_fanbase" required>
                    <option selected disabled>Pilih Fanbase</option>
                    ' . $pilihFanbase . '
                </select>
                <label for="fanbase" class="formbold-form-label">Fanbase</label>
            </div>
          </div>
          <div class="mb-3">
            <label for="foto_member" class="formbold-form-label">Foto Member</label>
            <input type="file" class="form-control" id="foto_member" name="foto_member" required>
          </div>
          <button class="formbold-btn" type="submit" name="submit">
              SUBMIT
          </button>
      </form>';

    if (isset($_POST['submit'])) {
        if ($member->addData($_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}


$member->close(); 

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_ADD', $data);

$view->write();