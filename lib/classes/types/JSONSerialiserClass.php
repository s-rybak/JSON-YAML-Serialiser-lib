<?php


class JSONSerialiserClass implements SerialiserInterface{

	public function serialize( $arr ) {

		return preg_replace("/\\\\u([a-f0-9]{4})/", "", json_encode($arr));

	}

}