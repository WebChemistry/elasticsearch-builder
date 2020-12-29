<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity;

use WebChemistry\ElasticsearchBuilder\Entity\ValueObject\Conditions;

final class BooleanQuery
{

	/** @var Conditions[] */
	private array $must = [];

	/** @var Conditions[] */
	private array $filter = [];

	/** @var Conditions[] */
	private array $mustNot = [];

	/** @var Conditions[] */
	private array $should = [];

	public function addMust(): Conditions
	{
		return $this->must[] = new Conditions();
	}

	public function addFilter(): Conditions
	{
		return $this->filter[] = new Conditions();
	}

	public function addMustNot(): Conditions
	{
		return $this->mustNot[] = new Conditions();
	}

	public function addShould(): Conditions
	{
		return $this->should[] = new Conditions();
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.Classes.UnusedPrivateElements.UnusedMethod
	 */
	private function mapConditions(Conditions $conditions): array
	{
		return $conditions->build();
	}

	public function build(): array
	{
		return ArrayResultBuilder::create()
			->addSkipIfEmpty('should', array_map([$this, 'mapConditions'], $this->should))
			->addSkipIfEmpty('must', array_map([$this, 'mapConditions'], $this->must))
			->addSkipIfEmpty('filter', array_map([$this, 'mapConditions'], $this->filter))
			->addSkipIfEmpty('must_not', array_map([$this, 'mapConditions'], $this->mustNot))
			->getResult();
	}

}
