<?php
/**
 *
 * @package mod_cfgrammar
 */

require('../../config.php');
require_once($CFG->dirroot . '/mod/cfgrammar/classes/output/table_renderer.php');

$cmid = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('cfgrammar', $cmid, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$cfg = $DB->get_record('cfgrammar', ['id' => $cm->instance], '*', MUST_EXIST);
$moduleinstance = $DB->get_record('cfgrammar', ['id' => $cm->instance], '*', MUST_EXIST);

$cyk = $DB->get_record('cfgrammar', ['id' => $cm->instance], '*', MUST_EXIST);
$rules = $DB->get_records('cfgrammar_rules', ['cfgrammarid' => $cyk->id]) ?? [];

$rulelist = array_values(
    array_map(function ($r) {
        return $r->lhs . ' → ' . $r->rhs;
    }, $rules)
);

$lhslist = array_values(
    array_map(function ($r) {
        return $r->lhs;
    }, $rules)
);

require_login($course, false, $cm);

$PAGE->set_url('/mod/cfgrammar/view.php', ['id' => $cm->id]);
$PAGE->set_title(format_string($cfg->name));
$PAGE->set_heading(format_string($course->fullname));

$PAGE->requires->js_call_amd('mod_cfgrammar/grammar', 'init', [$moduleinstance->id]);
$PAGE->requires->js_call_amd('mod_cfgrammar/student', 'init', [$cm->id]);

echo $OUTPUT->header();

echo $OUTPUT->render_from_template('mod_cfgrammar/student', [
    'inputstring' => $moduleinstance->inputstring,
]);

echo $OUTPUT->render_from_template('mod_cfgrammar/grammar', [
    'inputstring' => $moduleinstance->inputstring,
]);

$table = new \mod_cfgrammar\output\table_renderer(
    $cyk->inputstring,
    $rulelist,
    $lhslist
);

echo $OUTPUT->render($table);
echo $OUTPUT->footer();
