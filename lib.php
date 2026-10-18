<?php

defined('MOODLE_INTERNAL') || die();
require_once(__DIR__ . '/classes/local/generator.php');

/**
 * Add a new CF Grammar activity instance.
 */
function cfgrammar_add_instance($data)
{
    global $DB;

    $data->timecreated = time();

    $id = $DB->insert_record('cfgrammar', $data);

    $rules = cfgrammar_generator::generate_random_cfg_grammar(
        $data->minnonterminal,
        $data->maxnonterminal,
        $data->terminalnumber
    );

    foreach ($rules as $rule) {
        $DB->insert_record('cfgrammar_rules', (object)[
            'cfgrammarid' => $id,
            'lhs' => $rule['lhs'],
            'rhs' => $rule['rhs']
        ]);
    }

    $dbrules = $DB->get_records('cfgrammar_rules', ['cfgrammarid' => $id], '', 'id,cfgrammarid,lhs,rhs');

    $maxlen = isset($data->inputstringlength) ? (int)$data->inputstringlength : 10;
    $word = cfgrammar_generator::generate_cyk_word($dbrules, 'S', $maxlen);

    if (empty($word) || $word === 'error') {
        $word = 'a';
    }

    $update = new stdClass();
    $update->id = $id;
    $update->inputstring = $word;
    $update->timemodified = time();
    $DB->update_record('cfgrammar', $update);
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

        $DB->delete_records('cfgrammar_rules', ['cfgrammarid' => $id]);

    return $DB->delete_records('cfgrammar', ['id' => $id]);
}
