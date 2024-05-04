<?php

class Fanbase extends DB
{
    function getFanbase()
    {
        $query = "SELECT * FROM fanbase";
        return $this->execute($query);
    }

    function getFanbaseById($id)
    {
        $query = "SELECT * FROM fanbase WHERE id_fanbase=$id";
        return $this->execute($query);
    }

    function getFanbaseFiltered($filter = 'ASC')
    {
        $query = "SELECT * FROM fanbase";
        if ($filter == 'desc') {
            $query .= " ORDER BY nama_fanbase DESC";
        } else {
            $query .= " ORDER BY nama_fanbase ASC";
        }
        return $this->execute($query);
    }

    function addFanbase($data, $file)
    {
        $fanbase = $data['nama_fanbase'];

        $query = "INSERT INTO fanbase (nama_fanbase) VALUES ('$fanbase')";
        return $this->executeAffected($query);
    }

    function updateFanbase($id, $data, $file)
    {
        $fanbase = $data['nama_fanbase'];

        $query = "UPDATE fanbase SET nama_fanbase='$fanbase' WHERE id_fanbase=$id";
        return $this->executeAffected($query);
    }

    function deleteFanbase($id)
    {
        $query = "DELETE FROM fanbase WHERE id_fanbase=$id";
        return $this->executeAffected($query);
    }
}
