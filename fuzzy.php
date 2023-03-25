<?php
function fuzzy($rules, $input, $outputs) {
    foreach ($outputs as &$output) {
        foreach ($output as &$value) {
            $value = 0;
        }
    }

    foreach ($rules as $rule) {
        $inputs_value = [];

        foreach ($rule['inputs'] as $input => $value) {
            $inputs_value[$input] = $inputs_value[$input][$value];
        }

        $output_values = [];

        unset($output);
        foreach ($rule['outputs'] as $output => $value) {
            $output_values[$output] = $outputs[$output][$value];
        }

        $strength = $rule['weight'];

        foreach ($inputs_value as $value) {
            $strength *= $value;
        }
        foreach ($output_values as $output => $value) {
            $value = max($value, $strength);
        }
    }

    return $outputs;
}
