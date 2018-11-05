<?php

use PHPUnit\Framework\TestCase;

class YAMLSerialiserClassTest extends TestCase
{
    private $serialiser;

    protected function setUp()
    {
        parent::setUp();
        $this->serialiser = new SerialiserClass(new YAMLSerialiserClass());
    }

    public function testInstanceOfSerialiserInterface()
    {
        self::assertInstanceOf(SerialiserInterface::class, new YAMLSerialiserClass());
    }

    /**
     * @param Person $object
     * @param string $json
     *
     * @dataProvider serialiseDataProvider
     */
    public function testSerialize(Person $object, string $yaml)
    {
        $actual = $this->serialiser->serialize($object);

        self::assertEquals($yaml, $actual);
    }

    public function serialiseDataProvider()
    {
        yield
        [
            new Person("first name", "last name", 2),
            "---\nfirstName: first name\nlastName: last name\nage: 2\n"
        ];
        yield
        [
            new Person([ "a" => [ "b" => [ "c" => 1 ], "d" => 3 ] ], "a", 2),
            "---\nfirstName:\n\ta:\n\t\tb:\n\t\t\tc: 1\n\t\td: 3\nlastName: a\nage: 2\n"
        ];
        yield
        [
            new Person(2, 3, 4),
            "---\nfirstName: 2\nlastName: 3\nage: 4\n"
        ];
        yield
        [
            new Person(true, false, true),
            "---\nage: 1\n"
        ];
        yield
        [
            new Person(true, "Name", 88),
            "---\nlastName: Name\nage: 88\n"
        ];
    }
}
