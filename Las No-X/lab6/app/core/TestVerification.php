<?php

class TestVerification extends TestValidation
{

    public function verify()
    {
        if($this->_form['q1'] == '3' && $this->_form['q2'] == '120' && trim($this->_form['q3']) == 'смежными') {
            $message = 'Тест пройден';
        } else {
            $message = 'Вы где-то ошиблись';
        }

        $this->_result = $message;
    }

}