<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Tracy\BlueScreen;

use Throwable;
use Tracy\BlueScreen;

final class ElasticsearchBlueScreen
{

	public static function install(BlueScreen $blueScreen): void
	{
		$blueScreen->addPanel(function (?Throwable $exception) use ($blueScreen): ?array {
			if (!$exception instanceof ElasticsearchRequestFailedException) {
				return null;
			}

			return [
				'tab' => 'Elasticsearch response',
				'panel' => ($blueScreen->getDumper())($exception->getDebug()),
			];
		});
	}

}
