<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Tracy\Bar;

use Elasticsearch\Connections\ConnectionInterface;
use Elasticsearch\Transport as TransportAlias;
use GuzzleHttp\Ring\Future\FutureArrayInterface;

final class Transport
{

	private TransportAlias $decorate;

	private ElasticsearchBar $bar;

	public function __construct(TransportAlias $decorate, ElasticsearchBar $bar)
	{
		$this->decorate = $decorate;
		$this->bar = $bar;
	}

	public function getConnection(): ConnectionInterface
	{
		return $this->decorate->getConnection();
	}

	public function performRequest(
		string $method,
		string $uri,
		array $params = [],
		$body = null,
		array $options = []
	): FutureArrayInterface
	{
		$future = $this->decorate->performRequest($method, $uri, $params, $body, $options);

		$this->bar->queries++;

		$future->promise()->then(
			function ($response) {
				if (is_array($response) && isset($response['took'])) {
					$this->bar->time += (int) $response['took'];
				}
			}
		);

		return $future;
	}

	public function resultOrFuture(FutureArrayInterface $result, array $options = [])
	{
		return $this->decorate->resultOrFuture($result, $options);
	}

	public function shouldRetry(array $request): bool
	{
		return $this->decorate->shouldRetry($request);
	}

	public function getLastConnection(): ConnectionInterface
	{
		return $this->decorate->getLastConnection();
	}

}
