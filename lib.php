<?php

defined('MOODLE_INTERNAL') || die();

/**
 * Add a new CF Grammar activity instance.
 */
function cfgrammar_add_instance($data)
{
    global $DB;

    $data->timecreated = time();

    $id = $DB->insert_record('cfgrammar', $data);

    return $id;
}

/**
 * Update an existing CF Grammar activity instance.
 */
function cfgrammar_update_instance($data)
{
    global $DB;

    $data->timemodified = time();
    $data->id = $data->instance;

    $DB->update_record('cfgrammar', $data);

    return true;
}


/**
 * Delete a CF Grammar activity instance.
 */
function cfgrammar_delete_instance($id)
{
    global $DB;

    if (!$record = $DB->get_record('cfgrammar', ['id' => $id])) {
        return false;
    }

    return $DB->delete_records('cfgrammar', ['id' => $id]);
}
