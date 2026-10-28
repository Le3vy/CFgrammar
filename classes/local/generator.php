<?php

/**
 *
 * @package mod_cfgrammar
 */
class cfgrammar_generator {
    /**
     * Generate a random CFG word.
     */
    public static function generate_cfg_words($rules, $start, $maxlen) {

        return 'aabb';
    }

    /**
     * Generate a random CFG grammar
     */
    public static function generate_random_cfg_grammar($minnt, $maxnt, $terminalcount) {

        $rules = [
        ['lhs' => 'S', 'rhs' => 'AS\''],
        ['lhs' => 'S', 'rhs' => 'B'],
        ['lhs' => 'S\'', 'rhs' => 'SB'],
        ['lhs' => 'A', 'rhs' => 'a'],
        ['lhs' => 'B', 'rhs' => 'b'],
        ];

        return $rules;
    }

    /**
     *
     */
    public static function generate_cyk_word($rules, $start, $maxlen) {
        return 'aabb';
    }

    /**
     *
     */
    public static function generate_random_cyk_grammar($minnt, $maxnt, $terminalcount) {

        $rules = [
        ['lhs' => 'S', 'rhs' => 'AS\''],
        ['lhs' => 'S', 'rhs' => 'B'],
        ['lhs' => 'S\'', 'rhs' => 'SB'],
        ['lhs' => 'A', 'rhs' => 'a'],
        ['lhs' => 'B', 'rhs' => 'b'],
        ];

        return $rules;
    }
}
