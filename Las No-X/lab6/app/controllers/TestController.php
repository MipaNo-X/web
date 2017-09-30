<?php

class TestController
{

    public $_authOnly = [ 'result' ];

    function index() {
        $rules = [
            'name' => 'required,words:2-3',
            'group' => 'required',
            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
        ];
        $messages = [
            'name'  => [
                'required' => 'Поле обязательное',
                'words'    => 'Введите в формате: Фамилия Имя Отчество',
            ],
            'group' => [
                'required' => 'Поле обязательное',
            ],
            'q1'   => [
                'required' => 'Поле обязательное',
            ],
            'q2'   => 'Поле обязательное',
            'q3'   => 'Поле обязательное',
        ];
        $form = new Form($_POST, TestVerification::run($rules, $messages));
        if ($form->success()) {
            Test::create([
                'name'    => $form->val('name'),
                'group'   => $form->val('group'),
                'a1' => $form->val('q1'),
                'v1' => $form->val('q1') == '3',
                'a2' => $form->val('q2'),
                'v2' => $form->val('q2') == '120',
                'a3' => $form->val('q3'),
                'v3' => $form->val('q3') == 'смежными',
                'user_id' => Auth::instance()->is_guest ? null : Auth::instance()->user->id,
            ]);
        }

        include ROOT.'app/views/test.php';
    }

    function result() {
        $tests = Auth::instance()->is_admin ? Test::find() : Test::findBy( 'user_id', Auth::instance()->user->id );

        include ROOT.'app/views/test.result.php';
    }



}