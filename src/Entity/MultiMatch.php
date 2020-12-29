<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity;

final class MultiMatch
{

	private string $query;

	/** @var string[] */
	private array $fields = [];

	private ?string $type = null;

	public function __construct(string $query)
	{
		$this->query = $query;
	}

	public function setQuery(string $query): self
	{
		$this->query = $query;

		return $this;
	}

	public function addField(string $field, ?int $weight = null): self
	{
		$this->fields[] = $field . ($weight ? '^' . $weight : '');

		return $this;
	}

	/**
	 * @param string[] $fields
	 */
	public function setFields(array $fields): self
	{
		$this->fields = $fields;

		return $this;
	}

	/**
	 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-multi-match-query.html#multi-match-types
	 */
	public function setType(?string $type): self
	{
		$this->type = $type;

		return $this;
	}

	public function build(): array
	{
		return ArrayResultBuilder::create()
			->addSkipIfEmpty('query', $this->query)
			->addSkipIfEmpty('fields', $this->fields)
			->addSkipIfEmpty('type', $this->type)
			->getResult();
	}

}
