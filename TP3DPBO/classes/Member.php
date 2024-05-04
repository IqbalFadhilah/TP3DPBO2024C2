<?php

class Member extends DB
{
    function getMemberJoin()
    {
        $query = "SELECT * FROM member JOIN generasi ON member.id_gen=generasi.id_gen JOIN fanbase ON member.id_fanbase=fanbase.id_fanbase ORDER BY member.id_member";
        return $this->execute($query);
    }

    function getMember()
    {
        $query = "SELECT * FROM member";
        return $this->execute($query);
    }

    function getMemberById($id)
    {
        $query = "SELECT * FROM member WHERE id_member=$id";
        return $this->execute($query);
    }

    function searchMember($keyword)
    {
        $query = "SELECT * FROM member JOIN generasi ON member.id_gen=generasi.id_gen JOIN fanbase ON member.id_fanbase=fanbase.id_fanbase WHERE nama_member LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $nama_member = $data['nama_member'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $gol_darah = $data['gol_darah'];
        $horoskop = $data['horoskop'];
        $tinggi_badan = $data['tinggi_badan'];
        $id_gen = $data['id_gen'];
        $id_fanbase = $data['id_fanbase'];

        // Proses upload gambar
        $foto_member = null;
        if (!empty($file['foto_member']['name'])) {
            $nama_file = basename($file['foto_member']['name']); 
            if(move_uploaded_file($file['foto_member']['tmp_name'], 'assets/images/'.$nama_file)){
                $foto_member = $nama_file; 
            }
        }

        $query = "INSERT INTO member (nama_member, tanggal_lahir, gol_darah, horoskop, tinggi_badan, foto_member, id_gen, id_fanbase) VALUES ('$nama_member', '$tanggal_lahir', '$gol_darah', '$horoskop', '$tinggi_badan', '$foto_member', '$id_gen', '$id_fanbase')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $nama_member = $data['nama_member'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $gol_darah = $data['gol_darah'];
        $horoskop = $data['horoskop'];
        $tinggi_badan = $data['tinggi_badan'];
        $id_gen = $data['id_gen'];
        $id_fanbase = $data['id_fanbase'];
        

        $foto_member = null;
        if (!empty($file['foto_member']['name'])) {
            $nama_file = basename($file['foto_member']['name']); 
            if(move_uploaded_file($file['foto_member']['tmp_name'], 'assets/images/'.$nama_file)){
                $foto_member = $nama_file; 
            }
            $query = "UPDATE member SET nama_member='$nama_member', tanggal_lahir='$tanggal_lahir', gol_darah='$gol_darah', horoskop='$horoskop', tinggi_badan='$tinggi_badan', foto_member='$foto_member', id_gen='$id_gen', id_fanbase='$id_fanbase' WHERE id_member=$id";
        } else {
            $query = "UPDATE member SET nama_member='$nama_member', tanggal_lahir='$tanggal_lahir', gol_darah='$gol_darah', horoskop='$horoskop', tinggi_badan='$tinggi_badan', id_gen='$id_gen', id_fanbase='$id_fanbase' WHERE id_member=$id";
        }
        
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM member WHERE id_member=$id";
        return $this->executeAffected($query);
    }
}
