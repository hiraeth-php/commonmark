<?php

namespace Hiraeth\CommonMark;

use League\CommonMark;
use Hiraeth\Markdown\Parser;

/**
 * Provides proxying for CommonMark's Converter
 */
class Proxy implements Parser
{
	/**
	 * The markdown converter we're proxying
	 *
	 * @var CommonMark\Converter|null
	 */
	protected $converter = NULL;


	/**
	 * Create a new instance
	 *
	 * @return void
	 */
	public function __construct(CommonMark\Converter $converter)
	{
		$this->converter = $converter;
	}


	/**
	 * {@inheritDoc}
	 */
	public function parse(string $markdown): string
	{
		return $this->converter->convertToHtml($markdown);
	}
}
