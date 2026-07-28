<?php

class cfgrammar_generator
{
    /**
     * Generate one word from a CFG using simple leftmost derivation.
     *
     * @param array $rules DB records from cfgrammar_rules
     * @param string $start Start symbol (usually 'S')
     * @param int $maxlen Maximum allowed terminal length
     * @return string Generated word
     */
    public static function generate_words($rules, $start, $maxlen)
    {

        // Convert DB records into production map: S => [aA, bb, ...]
        $grammar = [];
        foreach ($rules as $r) {
            $grammar[$r->lhs][] = $r->rhs;
        }

        // Start with the start symbol
        $current = $start;

        // Expand until only terminals remain or max length reached
        for ($i = 0; $i < 50; $i++) {
            // If no uppercase letters remain → it's a terminal string
            if (!preg_match('/[A-Z]/', $current)) {
                if (strlen($current) <= $maxlen) {
                    return $current;
                }
            }

            // Find first nonterminal (leftmost)
            if (!preg_match('/[A-Z]/', $current, $match)) {
                break;
            }

            $nt = $match[0];

            // If grammar has no rule for this NT → stop
            if (!isset($grammar[$nt])) {
                break;
            }

            // Pick a random production
            $rhs = $grammar[$nt][array_rand($grammar[$nt])];

            // Replace only the first occurrence
            $current = preg_replace('/' . $nt . '/', $rhs, $current, 1);
        }

        // Fallback if no valid word was generated
        return 'error';
    }


    public static function generate_random_grammar($minNT, $maxNT, $terminalCount)
    {

        $nonterminals = [];
        $count = rand($minNT, $maxNT);

        for ($i = 0; $i < $count; $i++) {
            $nonterminals[] = chr(65 + $i); // A, B, C, ...
        }

        $terminals = [];
        for ($i = 0; $i < $terminalCount; $i++) {
            $terminals[] = chr(97 + $i); // a, b, c, ...
        }

        $rules = [];

        foreach ($nonterminals as $nt) {
            // Each nonterminal gets 1–3 productions
            $prodCount = rand(1, 3);

            for ($i = 0; $i < $prodCount; $i++) {
                $rhs = '';

                // RHS length 1–3
                $len = rand(1, 3);

                for ($j = 0; $j < $len; $j++) {
                    if (rand(0, 1)) {
                        $rhs .= $terminals[array_rand($terminals)];
                    } else {
                        $rhs .= $nonterminals[array_rand($nonterminals)];
                    }
                }

                $rules[] = ['lhs' => $nt, 'rhs' => $rhs];
            }
        }

        return $rules;
    }
}
