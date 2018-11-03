<?php

/**
 * Exception what throws when
 * data can`t be serialised
 */
class CantBeSerialisedException extends \Exception{

	public function __construct( string $message = "", int $code = 0, Throwable $previous = null ) {
		parent::__construct( $message, $code, $previous );
	}

}