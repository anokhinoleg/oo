<?php
namespace Model;

class RebelShip extends AbstractShip
{
    public function getFavoriteJedi()
    {
        $favoriteJedi = ['Yoda', 'Ben Kenobi'];
        $key = array_rand($favoriteJedi);
        return $favoriteJedi[$key];
    }

    public function getType()
    {
        return 'Rebel';
    }

    public function isFunctional()
    {
        return true;
    }

    public function getNameAndSpecs($useShortFormat = false)
    {
        $val = parent::getNameAndSpecs($useShortFormat);
        $val .= ' (Jedi)';
        return $val;
    }

    public function getJediFactor()
    {
        return rand(10, 30);
    }
}