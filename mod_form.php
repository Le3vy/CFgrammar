<?php

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/course/moodleform_mod.php');

class mod_cfgrammar_mod_form extends moodleform_mod
{
    public function definition()
    {
        global $PAGE;

        $mform = $this->_form;

        $mform->addElement('text', 'name', get_string('name', 'cfgrammar'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required');

        $mform->addElement('text', 'inputstring', get_string('inputstring', 'cfgrammar'));
        $mform->setType('inputstring', PARAM_TEXT);
        $mform->addRule('inputstring', null, 'required');

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }
}
