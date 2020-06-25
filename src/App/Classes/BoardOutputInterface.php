<?php
/**
 * Name: Doyche
 * Date: 25.06.2020.
 *
 */

namespace MyApp\Classes;

/**
 * Interface BoardOutputInterface
 * @package MyApp\Classes
 */
interface BoardOutputInterface {
    /**
     * @param $int
     * @return mixed
     */
    public function getBoardResult($int);
}