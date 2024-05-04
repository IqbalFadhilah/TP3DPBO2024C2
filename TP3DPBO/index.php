<?php
    include('config/db.php');
    include('classes/DB.php');
    include('classes/Template.php');
    include('classes/Member.php');
    include('classes/Gen.php');
    

    // buat instance pengurus
    $listMember = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // buka koneksi
    $listMember->open();
    // tampilkan data pengurus
    $listMember->getMemberJoin();

    // cari pengurus
    if (isset($_POST['btn-cari'])) {
        // methode mencari data pengurus
        $listMember->searchMember($_POST['cari']);
    } else {
        // method menampilkan data pengurus
        $listMember->getMemberJoin();
    }

    $data = null;

    // ambil data pengurus
    // gabungkan dgn tag html
    // untuk di passing ke skin/template
    while ($row = $listMember->getResult()) {
        $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
            '<div class="card pt-4 px-2 pengurus-thumbnail">
            <a href="detail.php?id=' . $row['id_member'] . '">
                <div class="row justify-content-center">
                    <img src="assets/images/' . $row['foto_member'] . '" class="card-img-top" alt="' . $row['foto_member'] . '">
                </div>
                <div class="card-body">
                    <p class="card-text pengurus-nama my-0">' . $row['nama_member'] . '</p>
                    <p class="card-text divisi-nama">' . $row['gen'] . '</p>
                    <p class="card-text jabatan-nama my-0">' . $row['nama_fanbase'] . '</p>
                </div>
            </a>
        </div>    
        </div>';
    }

    // tutup koneksi
    $listMember->close();

    $home = new Template('templates/skin.html');

    $home->replace('DATA_MEMBER', $data);
    $home->write();
?>