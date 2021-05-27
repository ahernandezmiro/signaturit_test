<?php

namespace LobbyWars;

use LobbyWars\Role;

class Signature
{
	protected $signers;
	protected $fullSign;

	public function __construct(string $s)
	{
		try{
			$s = trim($s);
			for($i = 0; $i < strlen($s); $i++)
			{
				$role = new Role($s[$i]);

				if($role->isEmpty() && $this->hasEmptySigners())
					throw new \Exception("Signature cannot have more than one empty signer");

				if(isset($this->signers[$role->getType()]))
					$this->signers[$role->getType()] += 1;
				else
					$this->signers[$role->getType()] = 1;
			}
			$this->fullSign = $s;
		} catch(Exception $e){
			throw new \Exception("Invalid signature: " . $e->getMessage());
		}
	}

	public function getTotalPoints() : int
	{	
		$v = 0;
		foreach($this->signers as $r => $nSigners)
		{
			$role = new Role($r);

			if($role->isValidator() && $this->hasKingSigners())
					continue;

			$v += $nSigners * $role->getPoints();
		}
		return $v;
	}

	protected function hasKingSigners() : bool
	{
		return isset($this->signers[Role::KING_ROLE]);
	}

	protected function hasEmptySigners() : bool
	{
		return isset($this->signers[Role::EMPTY_ROLE]);
	}

	public function getFullSign() : string
	{
		return $this->fullSign;
	}

	public function isKnownParty() : bool
	{
		return (!isset($this->signers[Role::EMPTY_ROLE]) || $this->signers[Role::EMPTY_ROLE] == 0);
	}

	public function getMinimumRoleToWin(Signature $s2) : Role
	{
		if($s2->isKnownParty())
		{
			if($this->signers[Role::EMPTY_ROLE] != 0)
			{
				$ourValue = $this->getTotalPoints();
				$theirValue = $s2->getTotalPoints();
				if($ourValue < $theirValue)
				{
					$dif = $theirValue - $ourValue;
					return Role::getMinimumRoleForPoints($dif);
				}
				else
					throw new \Exception("Signature value already greater"); //not sure about what to return in this cases
			}
			else
				throw new \Exception("No empty roles to change"); //not sure about what to return in this cases
		}
		else
			throw new \Exception("Opposition party has unknown member"); //not sure about what to return in this cases
	}

}