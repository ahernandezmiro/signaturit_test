<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use LobbyWars\Signature;

final class SignatureTest extends TestCase
{
	public function testCanCreateValidSignatureKN(): void
    {
		$signatuureToTest = 'KN';

        $signature = new Signature($signatuureToTest);
        
        $this->assertInstanceOf(Signature::class, $signature);
		$this->assertEquals($signature->getFullSign(), $signatuureToTest);
        $this->assertEquals($signature->getTotalPoints(), 7);
    }

    public function testCanCreateValidSignatureNNV(): void
    {
		$signatuureToTest = 'NNV';

        $signature = new Signature($signatuureToTest);
        
        $this->assertInstanceOf(Signature::class, $signature);
		$this->assertEquals($signature->getFullSign(), $signatuureToTest);
        $this->assertEquals($signature->getTotalPoints(), 5);
    }

    public function testCannotHaveMoreThanOneEmptySign(): void
    {
    	$failed = false;
    	try
    	{
			$signature = new Signature('NNV##');
    	}
    	catch(\Exception $e)
    	{
    		if($e->getMessage() == "Signature cannot have more than one empty signer")
    			$failed = true;
    	}
    	$this->assertTrue($failed);
    }

    public function testCannotCreateInvalidSignature(): void
    {
    	$failed = false;
    	try
    	{
	        $signature = new Signature('NP');
    	}
    	catch(\Exception $e)
    	{
    		if($e->getMessage() == "Invalid role P")
    			$failed = true;
    	}
        $this->assertTrue($failed);
    }

    public function testMinimumRoleToWin(): void
    {
    	$s1 = new Signature('N#V');
		$s2 = new Signature('NVV');

		$minimumRoleToWin = $s1->getMinimumRoleToWin($s2);
		$this->assertEquals($minimumRoleToWin->getType(), 'N');
    }
}