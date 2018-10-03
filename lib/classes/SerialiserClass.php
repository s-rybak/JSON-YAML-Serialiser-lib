<?php

class SerialiserClass {

	private $Serialiser;

	function __construct( SerialiserInterface $serialiser ) {

		$this->Serialiser = $serialiser;

	}

	private function toArray( $obj ) {

		$clsName     = get_class( $obj );
		$clsNameLen  = strlen( $clsName );
		$arr         = (array) $obj;
		$resultArray = [];

		$_obj = &$arr;

		foreach ( $_obj as $key => $value ) {

			if(!is_string($key)) continue;

			if ( strpos( $key, $clsName ) === 1 ) {

				$key =  str_replace($clsName,"",$key);

			}

			if( strpos( $key, "*" ) === 1 ){

				$key = substr( $key, 1 );

			}

			while (key_exists($key,$resultArray)){
				$key = "_".$key;
			}

			$resultArray[$key] = $value;

		}

		unset( $arr );
		unset( $_obj );

		return $resultArray;

	}

	public function serialize( $val ) {

		return $this->Serialiser->serialize( $this->toArray( $val ) );

	}

}