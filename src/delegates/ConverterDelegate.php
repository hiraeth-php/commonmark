<?php

namespace Hiraeth\CommonMark;

use Hiraeth;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Environment\Environment;

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
		return MarkdownConverter::class;
	}


	/**
	 * {@inheritDoc}
	 */
	public function __invoke(Hiraeth\Application $app): object
	{
		$options     = $app->getConfig('app', 'commonmark.options', []);
		$extensions  = $app->getConfig('*', 'commonmark.extensions', []);
		$environment = new Environment($options);

		if (count($extensions)) {
			foreach (array_merge(...array_values($extensions)) as $extension) {
				$environment->addExtension($app->get($extension));
			}
		}

		return $app->share(new MarkdownConverter($environment));
	}
}
