<?php


use PHPUnit\Framework\TestCase;

class JSONSerialiserClassTest extends TestCase {

	private $serialiser;

	protected function setUp() {
		parent::setUp();
		$this->serialiser = new JSONSerialiserClass();
	}

	public function testInstanceOfSerialiserInterface() {

		self::assertInstanceOf( SerialiserInterface::class, $this->serialiser );

	}

	/**
	 * @param Person $object
	 * @param string $json
	 *
	 * @dataProvider serialiseDataProvider
	 */
	public function testSerialize( Person $object, string $json ) {

		$serializerJSON = new SerialiserClass( $this->serialiser );

		$actual = $serializerJSON->serialize( $object );

		self::assertEquals( $json, $actual );

	}

	public function serialiseDataProvider() {

		yield
		[
			new Person( "first name", "last name", 2 ),
			'{"firstName":"first name","lastName":"last name","age":2}'
		];
		yield
		[
			new Person( [ "a" => [ "b" => [ "c" => 1 ], "d" => 3 ] ], "a", 2 ),
			'{"firstName":{"a":{"b":{"c":1},"d":3}},"lastName":"a","age":2}'
		];
		yield
		[
			new Person( 2, 3, 4 ),
			'{"firstName":2,"lastName":3,"age":4}'
		];

	}
}
