<?php
namespace Model;

abstract class AbstractShip
{
    private $id;

    private $name;

    private $weaponPower = 0;

    private $strength = 0;

    abstract public function getJediFactor();

    abstract public function getType();

    abstract public function isFunctional();

    public function __construct($name)
    {
        $this->name = $name;

    }

    public function __toString()
    {
        return $this->getName();
    }

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName , $val)
    {
        $this->$propertyName = $val;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    public function setStrength($strength)
    {
        if(!is_numeric($strength)) {
            throw new \Exception('Strength must be a number.');
        }
        $this->strength = $strength;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getWeaponPower()
    {
        return $this->weaponPower;
    }


    public function setWeaponPower($weaponPower)
    {
        $this->weaponPower = $weaponPower;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function sayHello()
    {
        echo 'Hello';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNameAndSpecs($useShortFormat = false)
    {
        if ($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->getJediFactor(),
                $this->strength
            );
        } else {
            return sprintf(
                '%s: w:%s, j:%s, s:%s',
                $this->name,
                $this->weaponPower,
                $this->getJediFactor(),
                $this->strength
            );
        }
    }


    public function doesGivenShipHaveMoreStrength($givenShip)
    {
        return $this->strength < $givenShip->strength;
    }
}