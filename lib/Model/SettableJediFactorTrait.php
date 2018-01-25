<?php
/**
 * Created by PhpStorm.
 * User: olegyurievich
 * Date: 02.10.17
 * Time: 18:22
 */

namespace Model;


trait SettableJediFactorTrait
{
    private $jediFactor;

    public function getJediFactor()
    {
        return $this->jediFactor;
    }

    public function setJediFactor($jediFactor)
    {
        $this->jediFactor = $jediFactor;
    }
}