<?php declare(strict_types = 1);

namespace WebChemistry\ElasticsearchBuilder\Utility;

final class SourceScript
{

	public static function valueWithDefault(string $field, string $default): string
	{
		return sprintf('doc["%s"].empty ? %s : doc["%s"].value', $field, $default, $field);
	}

	public static function decayDateGauss(string $parameterPath, string $value): string
	{
		return sprintf(
			'decayDateGauss(params.%s.origin, params.%s.scale, params.%s.offset, params.%s.decay, %s)',
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$value
		);
	}

	public static function decayDateExp(string $parameterPath, string $value): string
	{
		return sprintf(
			'decayDateExp(params.%s.origin, params.%s.scale, params.%s.offset, params.%s.decay, %s)',
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$value
		);
	}

	public static function decayDateLinear(string $parameterPath, string $value): string
	{
		return sprintf(
			'decayDateLinear(params.%s.origin, params.%s.scale, params.%s.offset, params.%s.decay, %s)',
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$value
		);
	}

	public static function decayNumericGauss(string $parameterPath, string $value): string
	{
		return sprintf(
			'decayNumericGauss(params.%s.origin, params.%s.scale, params.%s.offset, params.%s.decay, %s)',
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$value
		);
	}

	public static function decayNumericExp(string $parameterPath, string $value): string
	{
		return sprintf(
			'decayNumericExp(params.%s.origin, params.%s.scale, params.%s.offset, params.%s.decay, %s)',
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$parameterPath,
			$value
		);
	}

	public static function saturation(string $value, string $const): string
	{
		return sprintf('saturation(%s, %s)', $value, $const);
	}

}
