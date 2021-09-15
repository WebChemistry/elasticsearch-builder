<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Tracy\BlueScreen;

use Exception;
use Throwable;

final class ElasticsearchRequestFailedException extends Exception
{

	/**
	 * @param mixed[] $response
	 */
	public function __construct(
		private array $response,
	)
	{
		parent::__construct('Elasticsearch request failed.');
	}

	public function getDebug(): mixed
	{
		return $this->response['items'] ?? $this->response;
	}

}
