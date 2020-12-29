<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder;

use WebChemistry\ElasticsearchBuilder\Entity\ArrayResultBuilder;
use WebChemistry\ElasticsearchBuilder\Entity\Query;
use WebChemistry\ElasticsearchBuilder\Entity\Sort;

final class ElasticsearchBuilder
{

	private Query $query;

	private Sort $sort;

	private ?int $size = null;

	private ?int $from = null;

	public function __construct()
	{
		$this->query = new Query();
		$this->sort = new Sort();
	}

	public function setQuery(Query $query): void
	{
		$this->query = $query;
	}

	public function setSort(Sort $sort): void
	{
		$this->sort = $sort;
	}

	public function setFrom(?int $from): void
	{
		$this->from = $from;
	}

	public function setSize(?int $size): void
	{
		$this->size = $size;
	}

	public function getSort(): Sort
	{
		return $this->sort;
	}

	public function getQuery(): Query
	{
		return $this->query;
	}

	public function build(): array
	{
		return ArrayResultBuilder::create()
			->addSkipIfEmpty('query', $this->query->build())
			->addSkipIfEmpty('sort', $this->sort->build())
			->addSkipIf('size', $this->size, $this->size === null)
			->addSkipIf('from', $this->from, $this->from === null)
			->getResult();
	}

	public function buildCount(): array
	{
		return ArrayResultBuilder::create()
			->addSkipIfEmpty('query', $this->query->build())
			->getResult();
	}

}
