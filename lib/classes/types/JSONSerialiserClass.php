<?php
/**
 * JSON Serialiser Class
 *
 * serialise array to json
 *
 * @author  Sergey R <qwe@qwe.com>
 */
class JSONSerialiserClass implements SerialiserInterface
{
    /**
     * Serialise array to json using json_encode php function
     *
     * @param array $arr array to serialise
     *
     * @return string
     */
    public function serialize(array $arr): string
    {
        return preg_replace("/\\\\u([a-f0-9]{4})/", "", json_encode($arr));
    }
}
