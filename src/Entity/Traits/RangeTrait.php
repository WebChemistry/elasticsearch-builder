<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity\Traits;

trait RangeTrait
{

	/** @var mixed[] */
	private array $ranges = [];

	/**
	 * @param mixed[] $options
	 * @return static
	 * @example ->addRange('age', ['gte' => 10])
	 * @example ->addRange('age', ['gte' => 'now-10d/d'])
	 */
	public function addRange(string $field, array $options): self
	{
		$this->ranges[$field] = $options;

		return $this;
	}

	private function buildRange(): array
	{
		return $this->ranges;
	}

}
