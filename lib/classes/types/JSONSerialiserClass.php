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
     * @throws Exception
     */
    public function serialize(array $arr): string
    {
        $json = preg_replace("/\\\\u([a-f0-9]{4})/", "", json_encode($arr));

        if (json_last_error() === \JSON_ERROR_NONE) {
            return $json;
        }

        throw new CantBeSerialisedException("Can`t be converted");
    }
}
