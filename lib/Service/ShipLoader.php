<?php
namespace Service;

use Model\RebelShip;
use Model\Ship;
use Model\AbstractShip;
use Model\ShipCollection;
use Model\BountyHunterShip;

class ShipLoader
{

    private $shipStorage;


    public function __construct(ShipStorageInterface $shipStorage)

    {
        $this->shipStorage = $shipStorage;
    }


    /**
     * @return ShipCollection
     */
    public function getShips()
    {

        $ships = [];
        $shipsData = $this->queryForShips();

        foreach ($shipsData as $shipData) {
            $ships[] =$this->createShipFromData($shipData);

        }
        $ships[] = new BountyHunterShip('Slave I');

        return new ShipCollection($ships);

    }

    private function queryForShips()
    {
        try {
            return $this->shipStorage->fetchAllShipsData();
        } catch (\PDOException $e) {
            var_dump($e);
            trigger_error('Database Exception! ' . $e->getMessage());
            return [];
        }

    }

    /**
     * @param $id
     * @return null|AbstractShip
     */
    public function findOneById($id)
    {
        $shipArray = $this->shipStorage->fetchSingleShipData($id);
        return $this->createShipFromData($shipArray);
    }

    private function createShipFromData(array $shipData)
    {
        if ($shipData['team'] == 'empire') {
            $ship = new Ship($shipData['name']);
            $ship->setJediFactor($shipData['jedi_factor']);
        } else {
            $ship = new RebelShip($shipData['name']);
        }

        $ship->setId($shipData['id']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->strength = $shipData['strength'];
        return $ship;
    }

}