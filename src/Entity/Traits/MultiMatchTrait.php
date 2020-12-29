<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity\Traits;

use WebChemistry\ElasticsearchBuilder\Entity\MultiMatch;

trait MultiMatchTrait
{

	private MultiMatch $multiMatch;

	public function setMultiMatch(MultiMatch $multiMatch): self
	{
		$this->multiMatch = $multiMatch;

		return $this;
	}

	private function buildMultiMatch(): array
	{
		if (!isset($this->multiMatch)) {
			return [];
		}

		return $this->multiMatch->build();
	}

}
