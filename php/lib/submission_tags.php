<?php

function submit_tags($tags, $question_id) {
    global $db;

    if (count($tags) == 0) {
        return;
    }

    // get which tags are already present
    $parameters = "(";
    foreach($tags as $value) {
        $parameters = $parameters.
        "'$value',";
    }

    $parameters = substr($parameters, 0, -1).
    ")";

    $query = "SELECT tag_name FROM tags WHERE tag_name IN $parameters";
    $result = $db->query($query);
    $present_tags = array();
    while ($row = $result->fetch_assoc()) {
        $present_tags[$row['tag_name']] = 1;
    }

    // insert tags that aren't present yet
    $insert_parameters = "";
    foreach($tags as $value) {
        if (!array_key_exists($value, $present_tags)) {
            $insert_parameters = $insert_parameters.
            "('$value'),";
        }
    }
    $insert_parameters = substr($insert_parameters, 0, -1);
    $query = "INSERT INTO tags (tag_name) VALUES $insert_parameters";
    $db->query($query);

    // get ids of tags
    // reuses $parameters from earlier
    $query = "SELECT tag_id FROM tags WHERE tag_name IN $parameters";
    $result = $db->query($query);

    // insert tag association into has_tag
    $insert_parameters = "";
    while ($row = $result->fetch_assoc()) {
        $insert_parameters = $insert_parameters.
        "(".$question_id.
        ",".$row['tag_id'].
        "),";
    }
    $insert_parameters = substr($insert_parameters, 0, -1);
    $query = "INSERT INTO has_tags (question_fk, tag_fk) VALUES $insert_parameters";
    $db->query($query);
}


?>
