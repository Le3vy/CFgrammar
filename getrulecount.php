<?php

require('../../config.php');

$cfgrammarid = required_param('cfgrammarid', PARAM_INT);

$rulecount = $DB->count_records('cfgrammar_rules', ['cfgrammarid' => $cfgrammarid]);

echo json_encode(['rulecount' => $rulecount]);
