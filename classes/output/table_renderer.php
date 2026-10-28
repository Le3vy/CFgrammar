<?php

namespace mod_cfgrammar\output;

use renderable;
use templatable;
use renderer_base;

/**
 *
 * @package mod_cfgrammar
 */
class table_renderer implements renderable, templatable
{
    /**
     * @var input
     */
    private $input;

    /**
     * @var rules
     */
    private $rules;

    /**
     * @var lhrules
     */
    private $lhrules;

    /**
     *
     */
    public function __construct($inputstring, $rules, $lhrules) {
        $chars = preg_split('//u', trim($inputstring), -1, PREG_SPLIT_NO_EMPTY);
        $this->input = array_map('strval', $chars);
        $this->rules = $rules;
        $this->lhrules = $lhrules;
    }

    /**
     *
     */
    public function export_for_template(renderer_base $output) {
        $n = count($this->input);
        $rows = [];

        for ($l = 1; $l <= $n; $l++) {
            $cells = [];
            for ($i = 1; $i <= $n - $l + 1; $i++) {
                $cells[] = [
                    'id' => "cell_{$l}_{$i}",
                    'value' => '',
                    'lhrules' => $this->lhrules,
                ];
            }
            $rows[] = [
                'length' => $l,
                'cells' => $cells,
            ];
        }

        return [
            'rows' => array_reverse($rows),
            'symbols' => $this->input,
            'rules' => $this->rules,
            'lhrules' => $this->lhrules,
        ];
    }
}
