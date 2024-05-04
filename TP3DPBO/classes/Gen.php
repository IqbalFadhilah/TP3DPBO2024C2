<?php

class Generasi extends DB
{
    function getGenerasi()
    {
        $query = "SELECT * FROM generasi";
        return $this->execute($query);
    }

    function getGenerasiById($id)
    {
        $query = "SELECT * FROM generasi WHERE id_gen=$id";
        return $this->execute($query);
    }

    function getGenFiltered($filter = 'ASC')
    {
        $query = "SELECT * FROM generasi";
        if ($filter == 'desc') {
            $query .= " ORDER BY gen DESC";
        } else {
            $query .= " ORDER BY gen ASC";
        }
        return $this->execute($query);
    }

    function addGen($data, $file)
    {
        $gen = $data['gen'];

        $query = "INSERT INTO generasi (gen) VALUES ('$gen')";
        return $this->executeAffected($query);
    }

    function updateGen($id, $data, $file)
    {
        $gen = $data['gen'];

        $query = "UPDATE generasi SET gen='$gen' WHERE id_gen=$id";
        return $this->executeAffected($query);
    }

    function deleteGen($id)
    {
        $query = "DELETE FROM generasi WHERE id_gen=$id";
        return $this->executeAffected($query);
    }
}
