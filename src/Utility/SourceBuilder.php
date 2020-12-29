<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Utility;

final class SourceBuilder
{

	/** @var string[] */
	private array $script = [];

	public static function create(): self
	{
		return new self();
	}

	public function add(string $script, int $weight = 1): self
	{
		$this->script[] = $script . ($weight !== 1 ? '*' . $weight : '');

		return $this;
	}

	public function getScript(): string
	{
		return implode(' + ', $this->script);
	}

}
