<?php

class cfgrammar_generator
{

    public static function generate_cfg_words($rules, $start, $maxlen)
    {

        return 'aabb';
    }


    public static function generate_random_cfg_grammar($minNT, $maxNT, $terminalCount)
    {

        $rules = [
        ['lhs' => 'S',  'rhs' => 'AS\''],
        ['lhs' => 'S',  'rhs' => 'B'],
        ['lhs' => 'S\'', 'rhs' => 'SB'],
        ['lhs' => 'A',  'rhs' => 'a'],
        ['lhs' => 'B',  'rhs' => 'b'],
    ];

        return $rules;
    }



    
    public static function generate_cyk_word($rules, $start, $maxlen)
    {
        return 'aabb';
    }


    public static function generate_random_cyk_grammar($minNT, $maxNT, $terminalCount)
    {

        $rules = [
        ['lhs' => 'S',  'rhs' => 'AS\''],
        ['lhs' => 'S',  'rhs' => 'B'],
        ['lhs' => 'S\'', 'rhs' => 'SB'],
        ['lhs' => 'A',  'rhs' => 'a'],
        ['lhs' => 'B',  'rhs' => 'b'],
    ];

        return $rules;
    }
}
