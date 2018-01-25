<?php

use Service\BattleManager;
use Service\Container;
use Model\BrokenShip;

require __DIR__ . '/bootstrap.php';

$container = new Container($configuration);

$shipLoader = $container->getShipLoader();
$ships = $shipLoader->getShips();

$brokenShip = new BrokenShip('Just a hank of metal');
$ships[] = $brokenShip;
$ships->removeAllBrokenShips();
$battleTypes = BattleManager::getAllBattleTypesWithDescriptions();

if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'missing_data':
            $errorMessage = 'Don\'t forget to select ships';
            break;
        case 'bad_ships':
            $errorMessage = 'Yoa are trying';
            break;
        case 'bad_quantities':
            $errorMessage = 'Wrong number';
            break;
        default:
            $errorMessage = 'There was a confising in strangth ballance';
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OOP Battle</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>

        <?php if (isset($errorMessage)) { ?>
            <div>
                <?php echo $errorMessage; ?>
            </div>
        <?php } ?>

        <div class="container">
        <div class="page-header">
            <h1>00 Battleships of space</h1>
        </div>
        <table class="table table-hover">
            <caption><i class="fa fa-rocket"></i>This ships ready for the next battles</caption>
            <thead>
                <tr>
                    <th>Ship</th>
                    <th>Weapon power</th>
                    <th>Jedi factor</th>
                    <th>Srtength</th>
                    <th>Status</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($ships as $ship): ?>
                <tr>
                    <td><?php echo $ship->getName(); ?></td>
                    <td><?php echo $ship->getWeaponPower(); ?></td>
                    <td><?php echo $ship->getJediFactor(); ?></td>
                    <td><?php echo $ship->getStrength(); ?></td>
                    <td>
                        <?php if ($ship->isFunctional()): ?>
                            <i class="fa fa-sun-o"></i>
                        <?php else: ?>
                            <i class="fa fa-cloud"></i>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $ship->getType(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="battle-box center-block border"></div>
        <form method="POST" action="/battle.php">
            <h2 class="text-center">The Mission</h2>
            <input type="text" class="center-block form-control text-field" name="ship1_quantity" placeholder="Enter number of ships">
            <select class="center-block form-control btn drp-dwn-width btn-default btn-lg dropdown-toggle" name="ship1_id">
                <option value="">Choose a Ship</option>
                <?php foreach ($ships as $ship): ?>
                    <?php if ($ship->isFunctional()) : ?>
                    <option value="<?php echo $ship->getId(); ?>"><?php echo $ship->getNameAndSpecs(); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <br/>
            <p class="text-center">Against</p>
            <br/>
            <input type="text" class="center-block form-control text-field" name="ship2_quantity" placeholder="Enter number of ships">
            <select class="center-block form-control btn drp-dwn-width btn-default btn-lg dropdown-toggle" name="ship2_id">
                <option value="">Choose a Ship</option>
                <?php foreach ($ships as $ship): ?>
                    <?php if ($ship->isFunctional()) : ?>
                    <option value="<?php echo $ship->getId(); ?>"><?php echo $ship->getNameAndSpecs(); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <br>
            <div class="text-center">
                <label for="battle_type">Battle Type</label>
                <select name="battle_type" id="battle_type" class="form-control drp-dwn-width center-block">
                    <?php foreach ($battleTypes as $battleType => $typeName) : ?>
                        <option value="<?php echo $battleType; ?>"><?php echo $typeName; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br/>
            <button type="submit">Engage</button>
        </form>
        </div>
    </body>
</html>
