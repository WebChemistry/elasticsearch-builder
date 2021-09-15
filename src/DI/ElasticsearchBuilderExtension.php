<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\DI;

use Elasticsearch\Client;
use Nette\DI\CompilerExtension;
use Tracy\Bar;
use Tracy\BlueScreen;
use WebChemistry\ElasticsearchBuilder\Tracy\Bar\ElasticsearchBar;
use WebChemistry\ElasticsearchBuilder\Tracy\Bar\Transport;
use WebChemistry\ElasticsearchBuilder\Tracy\BlueScreen\ElasticsearchBlueScreen;

final class ElasticsearchBuilderExtension extends CompilerExtension
{

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('elasticsearch.bar'))
			->setType(ElasticsearchBar::class);

		$builder->addDefinition($this->prefix('blueSreen'))
			->setFactory(ElasticsearchBlueScreen::class);
	}

	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();

		$bar = $builder->getDefinition($this->prefix('elasticsearch.bar'));

		$builder->getDefinitionByType(Client::class)
			->addSetup('?->transport = new ' . Transport::class . '(?->transport, ?)', ['@self', '@self', $bar]);

		$builder->getDefinitionByType(Bar::class)
			->addSetup('?->addPanel(?, ?);', ['@self', $bar, 'elasticsearch']);

		$builder->getDefinitionByType(BlueScreen::class)
			->addSetup('?::install(?);', [ElasticsearchBlueScreen::class, '@self']);
	}

}
