<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Tracy\Bar;

use Tracy\IBarPanel;

final class ElasticsearchBar implements IBarPanel
{

	public int $queries = 0;

	public int $time = 0;

	public function getTab(): string
	{
		ob_start();

		// phpcs:disable
		$queries = $this->queries;
		$time = $this->time;
		// phpcs:enable

		require __DIR__ . '/templates/tab.phtml';

		return (string) ob_get_clean();
	}

	public function getPanel(): ?string
	{
		return null;
	}

}
