<?php
function retrieve_tag_names_like_string($string_param) {
    global $db;

    $string = $db->escape_string($string_param);

    $query = "SELECT tag_name FROM tags WHERE tag_name LIKE '%" . $string . "%'";

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all();
        return $rows;
    }
}

function retrieve_tag_names_with_limit($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT tag_name FROM tags LIMIT ". $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

function retrieve_tags_for_question($question_id_param) {
    global $db;

    if (!is_int($question_id_param)) {
        // ERROR
        $question_id = $db->escape_string($question_id_param);
    } else {
        $question_id = $question_id_param;
    }

    $query = "SELECT t.tag_id, t.tag_name FROM tags t ".
             "LEFT JOIN (SELECT * FROM has_tags WHERE question_fk = " . $question_id . ") ht " .
             "ON t.tag_id = ht.tag_fk";

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

?>
