<?php
require __DIR__ . '/vendor/autoload.php';

use LobbyWars\Contract;
use LobbyWars\Signature;

##first phase

$c = new Contract('KN', 'NNV');

echo $c->getPlaintiffSignature()->getFullSign() . " vs " . $c->getDefendantSignature()->getFullSign() . ":\n";

$winner = $c->getWinner();
if(is_null($winner))
	echo "Draw";
else
	echo $winner->getFullSign();

echo "\n\n";

##second phase

$s1 = new Signature('N#V');
$s2 = new Signature('NVV');
echo $s1->getFullSign() . " vs " . $s2->getFullSign() . ":\n";
echo "Minimum role to win trial: " . $s1->getMinimumRoleToWin($s2)->getType();
echo "\n";