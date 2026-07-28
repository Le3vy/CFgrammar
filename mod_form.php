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

        $mform->addElement('text', 'maxnonterminal', get_string('maxnonterminal', 'cfgrammar'));
        $mform->setType('maxnonterminal', PARAM_INT);
        $mform->addRule('maxnonterminal', null, 'required');
        $mform->addRule('maxnonterminal', null, 'numeric');

        $mform->addElement('text', 'minnonterminal', get_string('minnonterminal', 'cfgrammar'));
        $mform->setType('minnonterminal', PARAM_INT);
        $mform->addRule('minnonterminal', null, 'required');
        $mform->addRule('minnonterminal', null, 'numeric');

        $mform->addElement('text', 'inputstringlength', get_string('inputstringlength', 'cfgrammar'));
        $mform->setType('inputstringlength', PARAM_INT);
        $mform->addRule('inputstringlength', null, 'required');
        $mform->addRule('inputstringlength', null, 'numeric');

        $mform->addElement('text', 'terminalnumber', get_string('terminalnumber', 'cfgrammar'));
        $mform->setType('terminalnumber', PARAM_INT);
        $mform->addRule('terminalnumber', null, 'required');
        $mform->addRule('terminalnumber', null, 'numeric');

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }
}
