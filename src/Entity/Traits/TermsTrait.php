<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity\Traits;

trait TermsTrait
{

	/** @var mixed[] */
	private array $termsMany = [];

	/**
	 * @param mixed[] $options
	 * @return static
	 * @example ->addTerms('field', ['value', 'value2'])
	 */
	public function addTerms(string $field, array $options): self
	{
		$this->termsMany[$field] = $options;

		return $this;
	}

	private function buildTerms(): array
	{
		return $this->termsMany;
	}

}
