<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Gen.php');
include('classes/Template.php');

$generasi = new generasi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$generasi->open();         
$generasi->getGenerasi();   

$view = new Template('templates/skinform.html');

$mainTitle = 'generasi'; 


if (!isset($_GET['id'])) {  
    $title = 'Tambah';  

    $data = 
    '<form action="formAddgenerasi.php" method="POST" enctype="multipart/form-data">
          <div class="formbold-input">
            <div>
                <label for="gen" class="formbold-form-label"> Generasi </label>
                <input type="text" name="gen" id="gen" placeholder="Masukkan generasi" class="formbold-form-input" required/>
            </div>
          </div>
          <button class="formbold-btn" type="submit" name="submit">
              SUBMIT
          </button>
      </form>';

    if (isset($_POST['submit'])) {
        if ($generasi->addGen($_POST, $_FILES) > 0) {
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
}
    
$generasi->close(); 

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_ADD', $data);

$view->write();