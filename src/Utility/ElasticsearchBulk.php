<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Utility;

use Elasticsearch\Client;
use Nette\Utils\Json;

final class ElasticsearchBulk
{

	private string $body = '';

	private bool $send = false;

	public function create(string $index, $id, array $fields): self
	{
		$this->body .= Json::encode([
			'create' => [
				'_index' => $index,
				'_id' => $id,
			],
		]) . "\n" . Json::encode($fields) . "\n";
		
		return $this;
	}

	public function update(string $index, $id, array $fields): self
	{
		$this->body .= Json::encode([
			'update' => [
				'_index' => $index,
				'_id' => $id,
			],
		]) . "\n" . Json::encode([
			'doc' => $fields,
		]) . "\n";
		
		return $this;
	}

	public function delete(string $index, $id): self
	{
		$this->body .= Json::encode([
			'delete' => [
				'_index' => $index,
				'_id' => $id,
			],
		]) . "\n";
		
		return $this;
	}

	public function isSend(): bool
	{
		return $this->send;
	}

	public function reset(): void
	{
		$this->send = false;
		$this->body = '';
	}

	public function send(Client $client): void
	{
		$this->send = true;

		if (!$this->body) {
			return;
		}

		$client->bulk([
			'body' => $this->body,
		]);
	}

}
