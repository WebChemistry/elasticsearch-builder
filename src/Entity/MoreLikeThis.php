<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity;

final class MoreLikeThis
{

	/** @var string[] */
	private array $fields = [];

	/** @var mixed[] */
	private array $like = [];

	/** @var mixed[] */
	private array $options = [];

	public function addField(string $name): self
	{
		$this->fields[] = $name;

		return $this;
	}

	public function addLikeDocument(string $index, $id): self
	{
		$this->like[] = [
			'_index' => $index,
			'_id' => $id,
		];

		return $this;
	}

	public function setMinimumShouldMatch($value): self
	{
		$this->options['minimum_should_match'] = $value;

		return $this;
	}

	public function setAnalyzer(string $analyzer): self
	{
		$this->options['analyzer'] = $analyzer;

		return $this;
	}

	/**
	 * @return static
	 */
	public function setMinTermFreq($value)
	{
		$this->options['min_term_freq'] = $value;

		return $this;
	}

	public function build(): array
	{
		return ArrayResultBuilder::create()
			->setValues($this->options)
			->add('minimum_should_match', '1%')
			->add('analyzer', 'czech')
			->add('min_term_freq', 1)
			->addSkipIfEmpty('fields', $this->fields)
			->addSkipIfEmpty('like', $this->like)
			->getResult();
	}

}
