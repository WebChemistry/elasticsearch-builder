<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity\Traits;

use WebChemistry\ElasticsearchBuilder\Entity\MoreLikeThis;

trait MoreLikeThisTrait
{

	private MoreLikeThis $moreLikeThis;

	public function setMoreLikeThis(MoreLikeThis $moreLikeThis): void
	{
		$this->moreLikeThis = $moreLikeThis;
	}

	private function buildMoreLikeThis(): array
	{
		if (!isset($this->moreLikeThis)) {
			return [];
		}

		return $this->moreLikeThis->build();
	}

}
