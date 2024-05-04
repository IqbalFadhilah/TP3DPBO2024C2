<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Fanbase.php');
include('classes/Template.php');

$fanbase = new Fanbase($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$fanbase->open();         
$fanbase->getFanbase();   

$view = new Template('templates/skinform.html');

$mainTitle = 'fanbase'; 


if (!isset($_GET['id'])) {
    $btn = 'Tambah';    
    $title = 'Tambah';  
    
    $data = 
    '<form action="formAddfanbase.php" method="POST" enctype="multipart/form-data">
          <div class="formbold-input">
            <div>
                <label for="nama_fanbase" class="formbold-form-label"> Nama Fanbase </label>
                <input type="text" name="nama_fanbase" id="nama_fanbase" placeholder="Masukkan nama fanbase" class="formbold-form-input" required/>
            </div>
          </div>
          <button class="formbold-btn" type="submit" name="submit">
              SUBMIT
          </button>
      </form>';

   
    if (isset($_POST['submit'])) {
        if ($fanbase->addFanbase($_POST, $_FILES) > 0) {
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
}
    
$fanbase->close(); 

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_ADD', $data);

$view->write();