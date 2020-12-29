<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity\Traits;

trait MatchTrait
{

	/** @var mixed[] */
	private array $matches = [];

	/**
	 * @param mixed[] $options
	 * @example ->addMatch('message', ['query' => 'this is a test'])
	 */
	public function addMatch(string $field, array $options)
	{
		$this->matches[$field] = $options;
	}

	private function buildMatch(): array
	{
		return $this->matches;
	}

}
