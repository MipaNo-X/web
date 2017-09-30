<?php

class GuestController {

    public $_adminOnly = [ 'import' ];

	protected $_rules = [
		'name'  => 'required,words:2-3',
		'email' => 'required,email',
		'text'  => 'required',
	];
	protected $_messages = [
		'name'  => [
			'required' => 'Поле обязательное',
			'words'    => 'Введите в формате: Фамилия Имя Отчество',
		],
		'email' => [
			'required' => 'Поле обязательное',
			'email'    => 'Введите действительную почту',
		],
		'text'  => 'Поле обязательное',
	];

	protected $storage = ROOT.'storage/messages.inc';

	function index() {
		$form = new Form( $_POST, Validation::run( $this->_rules, $this->_messages ) );
		if ( $form->success() ) {
			$matches = mb_split( '\s+', $form->val( 'name' ) );
			$message = [
				'first_name'  => $matches[1],
				'last_name'   => $matches[0],
				'middle_name' => empty( $matches[2] ) ? '' : $matches[2],
				'email'       => $form->val( 'email' ),
				'text'        => preg_replace('/[\s;]/', ' ', $form->val( 'text' )),
			];
			$this->add_message( $message );
			$form->clear();
		}
		$messages = array_reverse($this->get_messages());

		include ROOT . 'app/views/guest.php';
	}

	private function add_message( $message ) {
		$message['date'] = date( 'H:i:s d.m.Y', time() );
		$file            = fopen( $this->storage, 'a' );
		fputs( $file, implode( ';', $message ) . PHP_EOL );
		fclose( $file );
	}

	private function get_messages() {
		$messages = [];
		if ( file_exists( $this->storage ) ) {
			$file = fopen( $this->storage, 'r' );

			while ( $tmp = fgets( $file ) ) {
				$tmp        = explode( ';', trim( $tmp ) );
				$messages[] = [
					'first_name'  => $tmp[0],
					'last_name'   => $tmp[1],
					'middle_name' => $tmp[2],
					'email'       => $tmp[3],
					'text'        => $tmp[4],
					'date'        => date_create_from_format( 'H:i:s d.m.Y', $tmp[5] ),
				];
			}
			fclose( $file );
		}

		return $messages;
	}

	function import() {
		$result = false;
		if ( count( $_POST ) && ! empty( $_FILES['file'] ) ) {
			$rewrite = ! empty( $_POST['rewrite'] );
			$file    = $_FILES['file'];
			if ( substr_compare( $file['name'], '.inc', - 4, 4, true ) !== 0 ) {
				$result = [
					'type'    => 'danger',
					'message' => 'Расширение файла должно быть .inc',
				];
			} else {
				$data   = file_get_contents( $file['tmp_name'] );
				$count  = $this->import_messages( $data, $rewrite );
				$result = [
					'type'    => 'success',
					'message' => sprintf( 'Успешно загружено %d записей', $count ),
				];
			}
		}

		include ROOT . 'app/views/guest.import.php';
	}

	private function import_messages( $data, $rewrite = false ) {
		$messages = $rewrite ? [] : $this->get_messages();
		$imported = 0;
		foreach ( explode( PHP_EOL, $data ) as $tmp ) {
			if ( empty( trim( $tmp ) ) ) {
				continue;
			}
			$tmp = explode( ';', trim( $tmp ) );
			if ( count( $tmp ) !== 6 ) {
				continue;
			}
			$date = date_create_from_format( 'H:i:s d.m.Y', $tmp[5] );
			if ( $date === false ) {
				continue;
			}
			$messages[] = [
				'first_name'  => $tmp[0],
				'last_name'   => $tmp[1],
				'middle_name' => $tmp[2],
				'email'       => $tmp[3],
				'text'        => $tmp[4],
				'date'        => date_create_from_format( 'H:i:s d.m.Y', $tmp[5] ),
			];
			$imported ++;
		}
		usort( $messages, function ( $a, $b ) {
			return $a['date']->getTimestamp() -
			       $b['date']->getTimestamp();
		} );
		foreach ( $messages as &$message ) {
			$message['date'] = $message['date']->format( 'H:i:s d.m.Y' );
		}

		$file = fopen( $this->storage, 'w' );
		foreach ( $messages as $message ) {
			fputs( $file, implode( ';', $message ) . PHP_EOL );
		}
		fclose( $file );

		return $imported;
	}

}