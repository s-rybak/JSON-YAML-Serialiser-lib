<?php
/**
 * Serialiser Interface
 *
 * defines necessary methods for serialiser class
 *
 * @author  Sergey R <qwe@qwe.com>
 */
interface SerialiserInterface
{
    /**
     * serialize logic realisation
     *
     * @param array $value array to serialise
     *
     * @return mixed
     */
    public function serialize(array $value): string;
}
