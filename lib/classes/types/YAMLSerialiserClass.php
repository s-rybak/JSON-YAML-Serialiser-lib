<?php
/**
 * YAML Serialiser Class
 *
 * serialise array to YAML using custom logic
 *
 * @author  Sergey R <qwe@qwe.com>
 */
class YAMLSerialiserClass implements SerialiserInterface
{
    public function serialize(array $value): string
    {
        return $this->arrayToYaml($value);
    }

    /**
     * Serialise array to YAML logic
     *
     * @param array $array current array witch need tobe serialised
     *
     * @param int $depth current depth
     *
     * @return string
     */
    public function arrayToYaml(array $array, int $depth = 0): string
    {
        $yaml_str = $depth > 0 ? "" : "---\n";
        $line     = str_repeat("\t", $depth);

        if (is_array($array)) {
            $_array = &$array;
            foreach ($_array as $key => $value) {
                if (is_numeric($value) || is_string($value)) {
                    $is_multiline = preg_match_all("/[\n]/", $value) > 0;
                    $yaml_str     .= $line .
                                     (is_int($key) ? "-" : $key . ($is_multiline > 0 ? ": |\n" : ": ")) .
                                     $value . "\n";
                } elseif (is_array($value) || is_object($value)) {
                    $yaml_str .= $line .
                                 (is_int($key) ? "-" : $key . ":") . "\n".
                                 $this->arrayToYaml((array) $value, $depth+1);
                }
            }

            unset($_array);
            unset($array);
        }

        $yaml_str = preg_replace("/\\\\u([a-f0-9]{4})/", "", json_encode($yaml_str));
        $yaml_str = json_decode($yaml_str);
        // TODO: fix this symbols
        return $yaml_str;
    }
}
