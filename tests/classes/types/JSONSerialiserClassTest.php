<?php


use PHPUnit\Framework\TestCase;

class JSONSerialiserClassTest extends TestCase
{

	public function testInstanceOfSerialiserInterface()
	{

		$serialiser = new JSONSerialiserClass();

		self::assertInstanceOf(SerialiserInterface::class,$serialiser);

	}
    public function testSerialize()
    {
        $sample = new Person("first name","last name", 2);
	    $serializerJSON = new SerialiserClass(new JSONSerialiserClass());

	    $actual =  $serializerJSON->serialize($sample) ;
        $expected = '{"firstName":"first name","lastName":"last name","age":2}';

        self::assertEquals($expected,$actual);

        $sample = new Person(["a"=>["b"=>["c"=>1],"d"=>3]],"a",2);

	    $actual =  $serializerJSON->serialize($sample) ;
	    $expected = '{"firstName":{"a":{"b":{"c":1},"d":3}},"lastName":"a","age":2}';

	    self::assertEquals($expected,$actual);

	    $sample = new Person(2,3,4);

	    $actual =  $serializerJSON->serialize($sample) ;
	    $expected = '{"firstName":2,"lastName":3,"age":4}';

	    self::assertEquals($expected,$actual);
    }
}
