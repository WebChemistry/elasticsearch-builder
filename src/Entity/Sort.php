<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity;

final class Sort
{

	/** @var mixed[] */
	private array $sorts = [];

	/**
	 * @param string|array $value
	 * @example ->add('_score')
	 * @example ->add(['date' => ['order' => 'asc'])
	 * @example ->add(['date' => 'asc')
	 */
	public function add($value): self
	{
		$this->sorts[] = $value;

		return $this;
	}

	public function build(): array
	{
		return ArrayResultBuilder::create()
			->setValues($this->sorts)
			->getResult();
	}

}
