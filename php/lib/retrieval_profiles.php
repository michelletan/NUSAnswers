<?php
function retrieve_profile_by_id($id_param) {
    global $db;

    $id = $db->escape_string($id_param);

    $query = "SELECT * FROM profiles WHERE profile_id = " . $id;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

?>
