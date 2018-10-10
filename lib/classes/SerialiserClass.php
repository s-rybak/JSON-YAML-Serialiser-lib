<?php
/**
 * Serialiser Class
 *
 * Serialise object to different format using right serialiser
 *
 * @author  Sergey R <qwe@qwe.com>
 */
class SerialiserClass
{
    private $Serialiser;

    public function __construct(SerialiserInterface $serialiser)
    {
        $this->Serialiser = $serialiser;
    }

    /**
     * Converts object to array
     *
     * @param object $obj
     *
     * @return array
     */
    private function toArray(object $obj): array
    {
        $clsName     = get_class($obj);
        $clsNameLen  = strlen($clsName);
        $arr         = (array) $obj;
        $resultArray = [];

        $_obj = &$arr;

        foreach ($_obj as $key => $value) {
            if (!is_string($key)) {
                continue;
            }

            if (strpos($key, $clsName) === 1) {
                $key =  str_replace($clsName, "", $key);
            }

            if (strpos($key, "*") === 1) {
                $key = substr($key, 1);
            }

            while (key_exists($key, $resultArray)) {
                $key = "_".$key;
            }

            $resultArray[$key] = $value;
        }

        unset($arr);
        unset($_obj);

        return $resultArray;
    }

    public function serialize(object $val): string
    {
        return $this->Serialiser->serialize($this->toArray($val));
    }
}
