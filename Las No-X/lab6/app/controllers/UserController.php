<?php

class UserController {

    public $_authOnly = [ 'stats' ];
    protected $_rulesSignUp = [
        'name'      => 'required,word:1',
        'password'  => 'required,min:8',
        'email'     => 'required,email',
        'real_name' => 'required,words:2-3',
    ];
    protected $_rulesSignIn = [
        'login'    => 'required',
        'password' => 'required',
    ];
    protected $_messages = [
        'login'     => [
            'sign_in' => 'Логин или пароль не правильный',
        ],
        'password'  => [
            'min' => 'Пароль должен быть не меньше 8 символов',
        ],
        'name'      => [
            'required' => 'Поле обязательное',
            'sign_up'  => 'Пользователь с таким логином уже зарегистрирован',
        ],
        'real_name' => [
            'required' => 'Поле обязательное',
            'words'    => 'Введите в формате: Фамилия Имя Отчество',
        ],
        'email'     => [
            'required' => 'Поле обязательное',
            'email'    => 'Введите действительную почту',
            'sign_up'  => 'Пользователь с такой почтой уже зарегистрирован',
        ],
        'tel'       => [
            'required' => 'Поле обязательное',
            'tel'      => 'Допустимы действительные номера +7 и +380',
        ],
        'sex'       => 'Поле обязательное',
        'age'       => 'Поле обязательное',
        'dob'       => [
            'required' => 'Поле обязательное',
            'date'     => 'Введите в формате: день.месяц.год',
        ],
    ];

    function sign_in() {
        if ( ! Auth::instance()->is_guest ) {
            header( 'Location: /' );
            exit;
        }
        $form = new Form( $_POST, UserVerification::run( $this->_rulesSignIn, $this->_messages, 'sign_in' ) );
        if ( $form->success() ) {
            $_SESSION['login']    = trim( $form->val( 'login' ) );
            $_SESSION['password'] = $form->val( 'password' );
            session_commit();
            header( 'Location: /' );
            exit;
        }

        include ROOT.'app/views/sign_in.php';
    }

    function sign_up() {
        if ( ! Auth::instance()->is_guest ) {
            header( 'Location: /' );
            exit;
        }
        $form = new Form( $_POST, UserVerification::run( $this->_rulesSignUp, $this->_messages, 'sign_up' ) );
        if ( $form->success() ) {
            User::create( [
                'name'      => trim( $form->val( 'name' ) ),
                'password'  => password_hash( $form->val( 'password' ), PASSWORD_BCRYPT ),
                'email'     => trim( $form->val( 'email' ) ),
                'real_name' => $form->val( 'real_name' ),
                'role'      => 'user',
            ] );
            $_SESSION['login']    = trim( $form->val( 'name' ) );
            $_SESSION['password'] = $form->val( 'password' );
            session_commit();
            header( 'Location: /' );
            exit;
        }

        include ROOT.'app/views/sign_up.php';
    }

    function sign_out() {
        Auth::instance()->logout();
        header( 'Location: /' );
        exit;
    }

}