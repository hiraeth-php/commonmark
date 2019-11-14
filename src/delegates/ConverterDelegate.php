<?php

namespace Hiraeth\CommonMark;

use Hiraeth;
use League\CommonMark;

/**
 * A Hiraeth Delegate capable of creating a CommonMark\Converter
 */
class ConverterDelegate implements Hiraeth\Delegate
{
	/**
	 * {@inheritDoc}
	 */
	public static function getClass(): string
	{
		return CommonMark\Converter::class;
	}


	/**
	 * {@inheritDoc}
	 */
	public function __invoke(Hiraeth\Application $app): object
	{
		$environment = CommonMark\Environment::createCommonMarkEnvironment();
		$extensions  = $app->getConfig('*', 'commonmark.extensions', []);

		if (count($extensions)) {
			foreach (array_merge(...array_values($extensions)) as $extension) {
				$environment->addExtension($app->get($extension));
			}
		}

		return $app->share(new CommonMark\Converter(
			new CommonMark\DocParser($environment),
			new CommonMark\HtmlRenderer($environment)
		));
	}
}
