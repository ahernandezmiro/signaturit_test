<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use LobbyWars\Role;

final class RoleTest extends TestCase
{
	public function testCanCreateKingRole(): void
    {
        $role = new Role('K');
        
        $this->assertInstanceOf(Role::class, $role);

		$this->assertEquals($role->getType(), 'K');
        $this->assertEquals($role->getPoints(), 5);

        $this->assertFalse($role->isValidator());
        $this->assertFalse($role->isEmpty());
    }

    public function testCanCreateNotaryRole(): void
    {
        $role = new Role('N');

        $this->assertInstanceOf(Role::class, $role);

		$this->assertEquals($role->getType(), 'N');
        $this->assertEquals($role->getPoints(), 2);

        $this->assertFalse($role->isValidator());
        $this->assertFalse($role->isEmpty());
    }

    public function testCanCreateValidatorRole(): void
    {
        $role = new Role('V');

        $this->assertInstanceOf(Role::class, $role);

		$this->assertEquals($role->getType(), 'V');
        $this->assertEquals($role->getPoints(), 1);

        $this->assertTrue($role->isValidator());
        $this->assertFalse($role->isEmpty());
    }

    public function testCanCreateEmptyRole(): void
    {
        $role = new Role('#');

        $this->assertInstanceOf(Role::class, $role);

        $this->assertEquals($role->getType(), '#');
        $this->assertEquals($role->getPoints(), 0);

        $this->assertTrue($role->isEmpty());
        $this->assertFalse($role->isValidator());
    }

    public function testCanotCreateInvalidRole(): void
    {
    	$failed = false;
    	try
    	{
        	$role = new Role('W');
    	}
    	catch(\Exception $e)
    	{
    		if($e->getMessage() == "Invalid role W")
    			$failed = true;
    	}
        $this->assertTrue($failed);
    }
}