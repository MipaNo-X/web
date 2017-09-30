<?php

class ContactController
{
    function index()
    {
        $rules = [
            'name' => 'required,words:2-3',
            'email' => 'required,email',
            'phone' => 'required,tel',
            'age' => 'required',
            'sex' => 'required',
            'dob' => 'required,date',
        ];
        $messages = [
            'name'  => [
                'required' => 'Поле обязательное',
                'words'    => 'Введите в формате: Фамилия Имя Отчество',
            ],
            'email' => [
                'required' => 'Поле обязательное',
                'email'    => 'Введите действительную почту',
            ],
            'phone'   => [
                'required' => 'Поле обязательное',
                'tel'      => 'Допустимы действительные номера +7 и +380',
            ],
            'sex'   => 'Поле обязательное',
            'age'   => 'Поле обязательное',
            'dob'   => [
                'required' => 'Поле обязательное',
                'date'     => 'Введите в формате: месяц.день.год',
            ],
        ];
        $form = new Form($_POST, Validation::run($rules, $messages));

        include ROOT . 'app/views/contact.php';
    }

}