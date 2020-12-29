<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity;

use WebChemistry\ElasticsearchBuilder\Entity\Traits\MatchTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\MoreLikeThisTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\MultiMatchTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\RangeTrait;
use WebChemistry\ElasticsearchBuilder\Entity\Traits\TermTrait;

final class Query
{

	use MultiMatchTrait;
	use MatchTrait;
	use RangeTrait;
	use TermTrait;
	use MoreLikeThisTrait;

	/** @var mixed[]|null */
	private ?array $matchAll = null;

	private ScriptScore $scriptScore;

	private BooleanQuery $booleanQuery;

	public function __construct()
	{
		$this->scriptScore = new ScriptScore();
		$this->booleanQuery = new BooleanQuery();
	}

	public function getMultiMatch(): MultiMatch
	{
		return $this->multiMatch;
	}

	public function setMatchAll(array $matchAll): self
	{
		$this->matchAll = $matchAll;

		return $this;
	}

	public function getScriptScore(): ScriptScore
	{
		return $this->scriptScore;
	}

	public function setScriptScore(ScriptScore $scriptScore): self
	{
		$this->scriptScore = $scriptScore;

		return $this;
	}

	public function getBool(): BooleanQuery
	{
		return $this->booleanQuery;
	}

	public function build(): array
	{
		$builder = ArrayResultBuilder::create()
			->addSkipIfEmpty('range', $this->buildRange())
			->addSkipIfEmpty('match', $this->buildMatch())
			->addSkipIfEmpty('term', $this->buildTerm())
			->addSkipIfEmpty('bool', $this->booleanQuery->build())
			->addSkipIfEmpty('multi_match', $this->buildMultiMatch())
			->addSkipIfEmpty('more_like_this', $this->buildMoreLikeThis())
			->addSkipIf('match_all', empty($this->matchAll) ? (object) [] : $this->matchAll, $this->matchAll === null);

		if ($this->scriptScore->isOk()) {
			return $this->scriptScore->build($builder->getResult());
		}

		return $builder->getResult();
	}

}
