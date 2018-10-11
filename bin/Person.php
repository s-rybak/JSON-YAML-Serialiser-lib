<?php

/**
 * Person class
 *
 * implements person data class
 *
 * @author  Sergey R <qwe@qwe.com>
 */
class Person
{
    private const MAX_POSSIBLE_AGE = 150;

    private $firstName;
    private $lastName;
    private $age;

    private static $maxAge = 0;

    public static function getOldest(): int
    {
        return self::$maxAge;
    }

    public function __construct($firstName, $lastName, $age = null)
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->setAge($age);
    }

    public function __destruct()
    {
    }

    public function __toString(): string
    {
        return $this->firstName . " " . $this->lastName . "\n";
    }

    /**
     * Add direct property access if it exists get
     *
     * @param string $prop
     *
     * @return mixed
     */
    public function __get(string $prop): string
    {
        $getter = 'get' . \ucfirst($prop);

        if (\method_exists($this, $getter)) {
            return $this->$getter();
        }

        echo "Cannot access property \n";

        return "";
    }


    /**
     * Add direct property access if it exists set
     *
     * @param string $name
     *
     * @param string $value
     */
    public function __set(string $name, string $value): void
    {
        $setter = 'set' . \ucfirst($name);

        if (\method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }

    public function __isset(string $prop): bool
    {
        return isset($this->$prop);
    }


    public function __unset(string $prop): void
    {
        unset($this->$prop);
    }

    /**
     *
     * @param string $value
     *
     * @return array
     */
    public function jsonSerialize(string $value = ''): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
        ];
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $name): void
    {
        $this->firstName = $name;
    }

    public function getLastName():string
    {
        return $this->lastName;
    }

    public function setLastName(string $name): void
    {
        $this->lastName = $name;
    }

    public function getAge(): string
    {
        return $this->age;
    }

    /**
     * Sets person age and check if it in allowed range
     *
     * @param int $age person age
     */
    public function setAge(int $age): void
    {
        if (self::MAX_POSSIBLE_AGE < $age) {
            echo sprintf("Impossible age %d", $age) . "\n";

            return;
        }

        $this->age = $age;

        if ($age > self::$maxAge) {
            self::$maxAge = $age;
        }
    }
}
