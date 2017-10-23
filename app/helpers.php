<?php

function input_with_label($type, $name, $value = null) {
    return bootstrap_input($type, $name, $value);
}

function bootstrap_input($type, $name, $value = null, $label = true, $required = false)
{
    $input = '<div class="form-group">'.PHP_EOL;

    if ($label !== false) {
        $input .= '<label for="' . $name . '" class="control-label">' . ucfirst($name) . '</label>' . PHP_EOL;
    }

    $input .= '<input class="form-control" type="'. $type. '" placeholder="'. ucfirst($name) . '" name="'. $name .'"';

    if (null !== $value) {
        $input .= ' value="' . $value . '"';
    }

    if ($required) {
        $input .= ' required';
    }

    $input .= '>'.PHP_EOL;
    $input .= '</div>'.PHP_EOL;

    return $input;
}