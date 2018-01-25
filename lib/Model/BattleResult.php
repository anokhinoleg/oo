<?php
namespace Model;

class BattleResult implements \ArrayAccess
{
    private $winningShip;

    private $losingShip;

    private $usedJediPowers;

    public function __construct(AbstractShip $winningShip = null, AbstractShip $losingShip = null, $usedJediPowers)
    {
        $this->winningShip = $winningShip;
        $this->losingShip = $losingShip;
        $this->usedJediPowers = $usedJediPowers;
    }

    public function getWinningShip()
    {
        return $this->winningShip;
    }

    public function getLosingShip()
    {
        return $this->losingShip;
    }

    public function getUsedJediPowers()
    {
        return $this->usedJediPowers;
    }

    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    /**
     * @return bool
     */
    public function isThereAWinner()
    {
        return $this->getWinningShip() !== null;
    }
}