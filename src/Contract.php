<?php

namespace LobbyWars;

use LobbyWars\Signature;

class Contract
{
	protected Signature $plaintiffSignature;
	protected Signature $defendantSignature;

	public function __construct(string $s, string $s2)
	{
		$this->plaintiffSignature = new Signature($s);
		$this->defendantSignature = new Signature($s2);
	}

	public function getPlaintiffSignature() : Signature
	{
		return $this->plaintiffSignature;
	}

	public function getDefendantSignature() : Signature
	{
		return $this->defendantSignature;
	}

	public function getWinner()
	{
		if($this->getPlaintiffSignature()->getTotalPoints() > $this->getDefendantSignature()->getTotalPoints())
			return $this->getPlaintiffSignature();
		else if($this->getPlaintiffSignature()->getTotalPoints() < $this->getDefendantSignature()->getTotalPoints())
			return $this->getDefendantSignature();
		else
			return null;
	}
}