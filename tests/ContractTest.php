<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use LobbyWars\Contract;

final class ContractTest extends TestCase
{
	public function testCanCreateContract(): void
    {
        $c = new Contract('KN', 'NNV');
        
        $this->assertInstanceOf(Contract::class, $c);

		$this->assertEquals($c->getPlaintiffSignature()->getFullSign(), 'KN');
        $this->assertEquals($c->getDefendantSignature()->getFullSign(), 'NNV');

        $this->assertEquals($c->getWinner()->getFullSign(), 'KN');
    }

    public function testComputeWinner(): void
    {
        $c = new Contract('KN', 'NNV');

        $this->assertEquals($c->getWinner()->getFullSign(), 'KN');
    }

    public function testDraw(): void
    {
        $c = new Contract('KN', 'NNNV');

        $this->assertNull($c->getWinner());
    }
}