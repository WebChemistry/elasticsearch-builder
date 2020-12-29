<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity\Traits;

trait TermTrait
{

	/** @var mixed[] */
	private array $terms = [];

	/**
	 * @param mixed[]|string $options
	 * @return static
	 * @example ->addTerm('field', 'value')
	 * @example ->addTerm('field', ['value' => 'value'])
	 */
	public function addTerm(string $field, $options): self
	{
		$this->terms[$field] = $options;

		return $this;
	}

	private function buildTerm(): array
	{
		return $this->terms;
	}

}
