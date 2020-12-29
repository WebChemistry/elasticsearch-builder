<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity\ValueObject;

use WebChemistry\ElasticsearchBuilder\Entity\ArrayResultBuilder;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\MatchTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\MoreLikeThisTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\MultiMatchTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\RangeTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\TermsTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\TermTrait;

final class Conditions
{

	use TermTrait;
	use MatchTrait;
	use RangeTrait;
	use TermsTrait;
	use MultiMatchTrait;
	use MoreLikeThisTrait;

	public function build(): array
	{
		return ArrayResultBuilder::create()
			->addSkipIfEmpty('term', $this->buildTerm())
			->addSkipIfEmpty('match', $this->buildMatch())
			->addSkipIfEmpty('range', $this->buildRange())
			->addSkipIfEmpty('terms', $this->buildTerms())
			->addSkipIfEmpty('multi_match', $this->buildMultiMatch())
			->addSkipIfEmpty('more_like_this', $this->buildMoreLikeThis())
			->getResult();
	}

}
