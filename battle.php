<?php

    use Service\Container;


    require __DIR__ . '/bootstrap.php';

    $container = new Container($configuration);
    $shipLoader = $container->getShipLoader();

    $ships = $shipLoader->getShips();

    $ship1Id = isset($_POST['ship1_id']) ? $_POST['ship1_id'] : null;
    $ship1Quantity = isset($_POST['ship1_quantity']) ? $_POST['ship1_quantity'] : 1;
    $ship2Id = isset($_POST['ship2_id']) ? $_POST['ship2_id'] : null;
    $ship2Quantity = isset($_POST['ship2_quantity']) ? $_POST['ship2_quantity'] : 1;

    if(!$ship1Id || !$ship2Id) {
        header('Location: /index.php?error=missing_data' );
        die;
    }


    $ship1 = $shipLoader->findOneById($ship1Id);
    $ship2 = $shipLoader->findOneById($ship2Id);

    if(!$ship1 || !$ship2) {
        header('Location: /index.php?error=bad_ships' );
        die;
    }
    if($ship1Quantity <= 0 || $ship2Quantity <= 0) {
        header('Location: /index.php?error=bad_quantities' );
        die;
    }


    //var_dump($ship1, $ship2);die;
    $battleManager = $container->getBattleManager();

    $battleType = $_POST['battle_type'];
    $battleResult = $battleManager->battle($ship1, $ship1Quantity, $ship2, $ship2Quantity, $battleType);

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
<div class="container">
    <div class="page-header">
        <h1>00 Battleships of space</h1>
    </div>
    <div>
        <h2 class="text-center">The Matchup:</h2>
        <p class="text-center">
            <br/>
                <?php echo $ship1Quantity; ?> <?php echo $ship1->getName(); ?>
                VS.
                <?php echo $ship2Quantity; ?> <?php echo $ship2->getName(); ?>
        </p>
    </div>
    <div class="result-block center-block">
        <h3 class="text-center audiowide">
            Winner:
            <?php if ($battleResult->isThereAWinner()): ?>
                <?php echo $battleResult['winningShip']->getName(); ?>
            <?php else: ?>
                Nobody
            <?php endif; ?>
        </h3>
        <p class="text-center">
            <?php if ($battleResult->isThereAWinner() == null ) : ?>
                Both ships destroyed each other.
            <?php else : ?>
                The <?php echo $battleResult['winningShip']->getName(); ?>
                <?php if ($battleResult->getUsedJediPowers()) : ?>
                    used it's jedi powers to stunning victory!
                <?php else : ?>
                    overpowered and destroyed the <?php echo $battleResult->getLosingShip()->getName(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </p>
        <h3>Remaining Strength</h3>
        <dl class="dl-horizontal">
            <dt><?php echo $ship1->getName(); ?></dt>
            <dd><?php echo $ship1->getStrength(); ?></dd>
            <dt><?php echo $ship2->getName(); ?></dt>
            <dd><?php echo $ship2->getStrength(); ?></dd>
        </dl>
    </div>
    <a href="/index.php">Battle again</a>
</div>
</body>
</html>