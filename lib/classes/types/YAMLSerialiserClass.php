<?php


class YAMLSerialiserClass implements SerialiserInterface {

	public function serialize( $value ) {

		return $this->arrayToYaml( $value );

	}

	public function arrayToYaml( $array, $depth = 0 ) {

		$yaml_str = $depth > 0 ? "" : "---\n";
		$line     = str_repeat( "\t", $depth );

		if ( is_array( $array ) ) {

			$_array = &$array;
			foreach ( $_array as $key => $value ) {

				if ( is_numeric( $value ) || is_string( $value ) ) {

					$is_multiline = preg_match_all( "/[\n]/", $value ) > 0;
					$yaml_str     .= $line .
					                 ( is_int( $key ) ? "-" : $key . ( $is_multiline > 0 ? ": |\n" : ": " ) ) .
					                 $value . "\n";

				} else if ( is_array( $value ) || is_object( $value ) ) {

					$yaml_str .= $line .
					             ( is_int( $key ) ? "-" : $key . ":" ) . "\n".
					             $this->arrayToYaml( (array) $value, $depth+1 );

				}

			}

			unset( $_array );
			unset( $array );

		}

		return $yaml_str;

	}

}