<?php
/**
 * Created by PhpStorm.
 * User: olegyurievich
 * Date: 02.10.17
 * Time: 18:13
 */

namespace Model;


class BountyHunterShip extends AbstractShip
{
    use SettableJediFactorTrait;

    public function getType()
    {
        return 'Bounty Hunter';
    }

    public function isFunctional()
    {
        return true;
    }



}