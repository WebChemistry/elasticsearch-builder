<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Entity;

final class ArrayResultBuilder
{

	private array $values = [];

	public static function create(): self
	{
		return new self();
	}

	public function setValues(array $values): self
	{
		$this->values = $values;

		return $this;
	}

	public function addSkipIfEmpty(string $key, $values): self
	{
		if (!empty($values)) {
			$this->values[$key] = $values;
		}

		return $this;
	}

	public function addSkipIf(string $key, $values, bool $skip): self
	{
		if (!$skip) {
			$this->values[$key] = $values;
		}

		return $this;
	}

	public function add(string $key, $values): self
	{
		$this->values[$key] = $values;

		return $this;
	}

	public function getResult(): array
	{
		return $this->values;
	}

}
