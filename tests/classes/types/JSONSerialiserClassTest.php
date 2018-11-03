<?php


use PHPUnit\Framework\TestCase;

class JSONSerialiserClassTest extends TestCase {

	private $serialiser;

	protected function setUp() {
		parent::setUp();
		$this->serialiser = new SerialiserClass( new JSONSerialiserClass() );
	}

	public function testInstanceOfSerialiserInterface() {

		self::assertInstanceOf( SerialiserInterface::class, new JSONSerialiserClass() );

	}

	/**
	 * @param Person $object
	 * @param string $json
	 *
	 * @dataProvider serialiseDataProvider
	 */
	public function testSerialize( Person $object, string $json ) {

		$actual = $this->serialiser->serialize($object);

		self::assertEquals( $json, $actual );

	}

	/**
	 * @expectedException CantBeSerialisedException
	 * @expectedExceptionMessage Can`t be converted
	 */
	public function testCannotBeConverted()
	{

		$wrongClass = new class {

			private $wrongData;

			public function __construct ()
			{

				$arr = [];
				$arrr = &$arr;

				for ($i = 0;$i<600;$i++){

					$arr[] = [];
					$arr = &$arr[0];

				}

				$this->wrongData = $arrr;
			}

		};

		$this->serialiser->serialize($wrongClass);

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
		yield
		[
			new Person( true, false, true ),
			'{"firstName":true,"lastName":false,"age":1}'
		];
		yield
		[
			new Person( true, "Name", 88 ),
			'{"firstName":true,"lastName":"Name","age":88}'
		];

	}
}
