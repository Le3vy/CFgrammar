<?php
/**
 *
 * @package mod_cfgrammar
 */

require('../../config.php');
require_login();

$cfgrammarid = required_param('cfgrammarid', PARAM_INT);

$rulecount = $DB->count_records('cfgrammar_rules', ['cfgrammarid' => $cfgrammarid]);

echo json_encode(['rulecount' => $rulecount]);
