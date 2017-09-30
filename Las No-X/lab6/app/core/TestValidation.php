<?php

class TestValidation extends Validation
{

    public function isCount($field, $value)
    {
        $count = 0;
        foreach ($this->_form as $key => $val) {
            if (substr_compare($key, $field, 0, strlen($field), true) == 0 && $val == true) {
                $count++;
            }
        }
        $tmp = explode('-', $value[0]);
        if (count($tmp) === 1) {
            return $count === $tmp[0];
        } elseif (count($tmp) === 2) {
            return $count >= $tmp[0] && $count <= $tmp[1];
        }
    }

}