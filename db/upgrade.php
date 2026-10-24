<?php

defined('MOODLE_INTERNAL') || die();

function xmldb_cfgrammar_upgrade($oldversion) {

    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2026101701) {

        $table = new xmldb_table('cfgrammar');

        $fields = [
            new xmldb_field('minnonterminal', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '3'),
            new xmldb_field('maxnonterminal', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '4'),
            new xmldb_field('terminalnumber', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '2'),
            new xmldb_field('inputstringlength', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '3'),
        ];

        foreach ($fields as $field) {
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }
        }

        upgrade_mod_savepoint(true, 2026101701, 'cfgrammar');
    }
    return true;
}