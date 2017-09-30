<?php

class BlogController {

    public $_adminOnly = [ 'create', 'import' ];
	protected $per_page = 10;
	protected $_rules = [
		'title'   => 'required',
		'message' => 'required',
	];
	protected $_messages = [
		'title'   => [
			'required' => 'Поле обязательное',
			'words'    => 'Введите заголовок',
		],
		'message' => [
			'required' => 'Поле обязательное',
			'email'    => 'Введите содержимое поста',
		],
	];

	function index() {
		$this->page( 1 );
	}

	function page( $n ) {
		$total = (int) ceil( Post::count() * 1.0 / $this->per_page );
		if ( $n <= 0 || $n > $total ) {
			$n = 1;
		}
		$posts    = Post::paginate( $this->per_page * ( $n - 1 ), $this->per_page ) ?: [];
		$count    = count( $posts );
		$paginate = [
			'per_page'   => $this->per_page,
			'on_page'    => $count,
			'is_empty'   => count( $posts ) === 0,
			'current'    => $n,
			'total'      => $total,
			'is_last'    => $n >= $total,
			'is_first'   => $n == 1,
			'left_tail'  => max( 1, $n - 2 ),
			'right_tail' => min( $total, $n + 2 ),
			'prev'       => max( 1, $n - 1 ),
			'next'       => min( $total, $n + 1 ),
		];

        include ROOT.'app/views/blog.php';
		//view( 'blog.index', compact( 'posts', 'paginate' ) );
	}

	function create() {
		$form = new Form( $_POST, Validation::run( $this->_rules, $this->_messages ) );
		if ( $form->success() ) {
			$image = '';
			$error = false;
			if ( ! empty( $_FILES['image'] ) ) {
				$file  = $_FILES['image'];
				if($file['error']) {
					$form->error('image', 'Файл слишком большой');
					$error = true;
				} else {
					$image = sprintf(
						'/uploads/%s.%s',
						hash( 'sha256', $file['name'] . time() ),
						pathinfo( $file['name'], PATHINFO_EXTENSION )
					);
					$img = new \Imagick( $file['tmp_name'] );
					$img->scaleImage( 300, 300, true );
					$img->writeImage( ROOT . 'public' . $image );
					$img->destroy();
				}
			}
			if(!$error) {
				Post::create( [
					'title'   => $form->val( 'title' ),
					'message' => $form->val( 'message' ),
					'image'   => $image,
				] );
				header( 'Location: /blog' );
				exit;
			}
		}

        include ROOT.'app/views/blog.create.php';
		//view( 'blog.create', compact( 'form' ) );
	}

	function import() {
		$result = false;
		if ( count( $_POST ) && ! empty( $_FILES['file'] ) ) {
			$rewrite = ! empty( $_POST['rewrite'] );
			$file    = $_FILES['file'];
			if ( substr_compare( $file['name'], '.csv', - 4, 4, true ) !== 0 ) {
				$result = [
					'type'    => 'danger',
					'message' => 'Расширение файла должно быть .csv',
				];
			} else {
				$data   = file_get_contents( $file['tmp_name'] );
				$count  = $this->import_posts( $data, $rewrite );
				$result = [
					'type'    => 'success',
					'message' => sprintf( 'Успешно загружено %d записей', $count ),
				];
			}
		}

        include ROOT.'app/views/blog.import.php';
		//view( 'blog.import', compact( 'result' ) );
	}

	protected function import_posts( $data, $rewrite ) {
		$imported = 0;
		if ( $rewrite ) {
			Post::deleteAll();
		}
		foreach ( explode( PHP_EOL, $data ) as $tmp ) {
			if ( empty( trim( $tmp ) ) ) {
				continue;
			}
			$tmp = explode( '","', substr( trim( $tmp ), 1, - 1 ) );
			if ( count( $tmp ) !== 4 ) {
				continue;
			}
			$created_at = date_create_from_format( 'H:i:s d.m.Y', $tmp[3] );
			if ( $created_at === false ) {
				continue;
			}
			$post = Post::create( [
				'title'      => trim( $tmp[0] ),
				'message'    => trim( $tmp[1] ),
				'image'      => trim( $tmp[2] ),
				'created_at' => $created_at->format( 'Y-m-d H:i:s' ),
			] );
			if ( $post->inserted() ) {
				$imported ++;
			}
		}

		return $imported;
	}

}