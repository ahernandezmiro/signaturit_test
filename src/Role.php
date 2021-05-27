<?php

namespace LobbyWars;

class Role
{
	const KING_ROLE = 'K';
	const NOTARY_ROLE = 'N';
	const VALIDATOR_ROLE = 'V';
	const EMPTY_ROLE = '#';

	const ROLE_POINTS = [
		self::EMPTY_ROLE => 0,
		self::VALIDATOR_ROLE => 1,
		self::NOTARY_ROLE => 2,
		self::KING_ROLE => 5
	];

	protected string $type;
	protected string $fullSign;

	public function __construct(string $r)
	{
		if($this->isValidRole($r))
			$this->type = $r;
		else
			throw new \Exception("Invalid role " . $r);
	}

	public function getType() : string
	{
		return $this->type;
	}

	public function getPoints() : int
	{	
		return self::ROLE_POINTS[$this->type];
	}

	public function isValidRole(string $r) : bool
	{
		return array_key_exists($r, self::ROLE_POINTS);
	}

	public function isValidator() : bool
	{
		return $this->type == self::VALIDATOR_ROLE;
	}

	public function isEmpty() : bool
	{
		return $this->type == self::EMPTY_ROLE;
	}

	public static function getMinimumRoleForPoints(int $minPoints) : Role
	{
		foreach(self::ROLE_POINTS as $role => $points)
		{
			if($points > $minPoints)
				return new Role($role);
		}

		throw \Exception("No defined roles fullfill opposition value");
	}

}