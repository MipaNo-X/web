<?php

class ActiveRecord {
	protected static $table = '';
	protected static $id_field = 'id';
	protected static $fields = [
		'id',
	];

	protected $_attributes = [];
	protected $_original = [];
	protected $_inserted = false;
	protected $_lastError = false;

	public function __construct( array $attributes = [], bool $inserted = false ) {
		$this->_attributes = $attributes;
		if ( $inserted ) {
			$this->_inserted = $inserted;
			$this->_original = $this->_attributes;
		}
	}

	/**
	 * @param array $attributes
	 *
	 * @return static
	 */
	public static function create( array $attributes ) {
		$instance = new static( $attributes );
		$instance->save();

		return $instance;
	}

	/**
	 * @return bool
	 */
	public function save() {
		$table    = static::$table;
		$prepares = [];
		$values   = [];
		$fields   = [];

		if ( $this->_inserted ) {
			$id_field              = static::$id_field;
			$id_prepare            = ":__$id_field";
			$values[ $id_prepare ] = $this->_original[ static::$id_field ];
			foreach ( $this->_attributes as $key => $value ) {
				if ( $this->_original[ $key ] !== $value ) {
					$prepares[]           = "`$key` = :$key";
					$values[ ':' . $key ] = $value;
				}
			}
			if ( ! empty( $prepares ) ) {
				$keys    = implode( ', ', $prepares );
				$prepare = pdo()->prepare( "UPDATE `$table` SET $keys WHERE $id_field = $id_prepare" ); // UPDATE `user` SET `name` = :name WHERE id = :__id
				if ( $prepare->execute( $values ) ) {
					$this->_original = array_merge( $this->_original, $this->_attributes );

					return true;
				} else {
					$this->_lastError = [
						'code' => $prepare->errorCode(),
						'info' => $prepare->errorInfo(),
					];

					return false;
				}
			}

			return true;
		} else {
			foreach ( $this->_attributes as $key => $value ) {
				$fields[]             = "`$key`";
				$prepares[]           = ":$key";
				$values[ ':' . $key ] = $value;
			}
			if ( ! empty( $prepares ) ) {
				$fields  = implode( ', ', $fields );
				$keys    = implode( ', ', $prepares );
				$prepare = pdo()->prepare( "INSERT INTO `$table`($fields) VALUES($keys)" );
				if ( $prepare->execute( $values ) ) {
					if ( empty( $this->_attributes[ static::$id_field ] ) ) {
						$this->_attributes[ static::$id_field ] = pdo()->lastInsertId();
					}
					$this->_original = array_merge( $this->_original, $this->_attributes );
					$this->_inserted = true;

					return true;
				} else {
					$this->_lastError = [
						'code' => $prepare->errorCode(),
						'info' => $prepare->errorInfo(),
					];

					return false;
				}
			}

			return false;
		}
	}

	/**
	 * @param bool $id
	 *
	 * @return static[]|bool|static
	 */
	public static function find( $id = false ) {
		$table = static::$table;
		if ( $id !== false ) {
			$id_field   = static::$id_field;
			$id_prepare = ":__$id_field";
			$prepare    = pdo()->prepare( "SELECT * FROM `$table` WHERE `$id_field` = $id_prepare" );
			$prepare->bindValue( $id_prepare, $id );
		} else {
			$prepare = pdo()->prepare( "SELECT * FROM `$table`" );
		}
		if ( $prepare->execute() ) {
			if ( $id !== false ) {
				return ( $row = $prepare->fetch( \PDO::FETCH_ASSOC ) ) !== false ? new static( $row, true ) : false;
			} else {
				$result = [];
				foreach ( $prepare->fetchAll( \PDO::FETCH_ASSOC ) as $data ) {
					$result[] = new static( $data, true );
				}

				return $result;
			}
		} else {
			return false;
		}
	}

	/**
	 * @param $column
	 * @param $value
	 * @param bool $one
	 *
	 * @return array|bool|static
	 */
	public static function findBy( $column, $value, $one = false ) {
		$table        = static::$table;
		$column_field = ":__$column";
		$prepare      = pdo()->prepare( "SELECT * FROM `$table` WHERE `$column` = $column_field" );
		$prepare->bindValue( $column_field, $value );
		if ( $prepare->execute() ) {
			if ( $one ) {
				return ( $row = $prepare->fetch( \PDO::FETCH_ASSOC ) ) !== false ? new static( $row, true ) : false;
			} else {
				$result = [];
				foreach ( $prepare->fetchAll( \PDO::FETCH_ASSOC ) as $data ) {
					$result[] = new static( $data, true );
				}

				return $result;
			}
		} else {
			return false;
		}
	}

	/**
	 * @param int $offset
	 * @param int $limit
	 *
	 * @return array|bool
	 */
	public static function paginate( $offset = 0, $limit = 0 ) {
		$table   = static::$table;
		$prepare = pdo()->prepare( "SELECT * FROM `$table` ORDER BY `created_at` DESC LIMIT :offset, :limit" );
		$prepare->bindParam( ':offset', $offset, \PDO::PARAM_INT );
		$prepare->bindParam( ':limit', $limit, \PDO::PARAM_INT );
		if ( $prepare->execute() ) {
			$result = [];
			foreach ( $prepare->fetchAll( \PDO::FETCH_ASSOC ) as $data ) {
				$result[] = new static( $data, true );
			}

			return $result;
		} else {
			return false;
		}
	}

	/**
	 * @return int|string
	 */
	public static function count() {
		$table    = static::$table;
		$id_field = static::$id_field;
		$prepare  = pdo()->prepare( "SELECT COUNT(`$id_field`) FROM `$table`" );
		if ( $prepare->execute() ) {
			return $prepare->fetchColumn();
		} else {
			return 0;
		}
	}

	/**
	 * @return bool
	 */
	public static function deleteAll() {
		$table = static::$table;

		return pdo()->prepare( "DELETE FROM `$table`" )->execute();

	}

	/**
	 * @return $this|bool
	 */
	public function delete() {
		if ( $this->_inserted ) {
			$table      = static::$table;
			$id_field   = static::$id_field;
			$id_prepare = ":__$id_field";
			$prepare    = pdo()->prepare( "DELETE FROM `$table` WHERE `$id_field` = $id_prepare" );
			$prepare->bindValue( $id_prepare, $this->_original[ $id_field ] );

			if ( $prepare->execute() ) {
				$this->_inserted = false;

				return true;
			} else {
				$this->_lastError = [
					'code' => $prepare->errorCode(),
					'info' => $prepare->errorInfo(),
				];

				return $this;
			}
		}

		return $this;
	}

	public function __get( $name ) { // $user->name $user->__get('name') return $user->_attributes['name']
		if ( array_key_exists( $name, $this->_attributes ) ) {
			return $this->_attributes[ $name ];
		}

		return null;
	}

	public function __set( $name, $value ) { // $user->name = 'asd';
		if ( in_array( $name, static::$fields ) ) {
			$this->_attributes[ $name ] = $value;
		}
	}

	public function inserted() {
		return $this->_inserted;
	}

}