<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity;

final class ScriptScore
{

	private string $source = '';

	/** @var mixed[] */
	private array $params = [];

	public function getSource(): string
	{
		return $this->source;
	}

	/**
	 * @return mixed[]
	 */
	public function getParams(): array
	{
		return $this->params;
	}

	public function setSource(string $source): self
	{
		$this->source = $source;

		return $this;
	}

	public function setParams(array $params): self
	{
		$this->params = $params;

		return $this;
	}

	public function isOk(): bool
	{
		return (bool) $this->source;
	}

	public function build(array $query): array
	{
		return [
			'script_score' => ArrayResultBuilder::create()
				->add(
					'script',
					ArrayResultBuilder::create()
						->add('source', $this->source)
						->addSkipIfEmpty('params', $this->params)
						->getResult()
				)
				->addSkipIfEmpty('query', $query)
				->getResult(),
		];
	}

}
