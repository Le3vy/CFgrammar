<?php

require('../../config.php');

$id = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('cfgrammar', $id, 0, false, MUST_EXIST);
$moduleinstance = $DB->get_record('cfgrammar', ['id' => $cm->instance], '*', MUST_EXIST);
$rules = $DB->get_records('cfgrammar_rules', ['cfgrammarid' => $cm->instance]);

require_once(__DIR__ . '/classes/local/generator.php');

$word = cfgrammar_generator::generate_cfg_words(
    $rules,
    'S',
    $moduleinstance->inputstringlength
);

echo json_encode(['word' => $word]);
die;
