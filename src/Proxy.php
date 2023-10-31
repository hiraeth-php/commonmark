<?php

namespace Hiraeth\CommonMark;

use League\CommonMark;
use Hiraeth\Markdown\Parser;
use League\CommonMark\MarkdownConverter;

/**
 * Provides proxying for CommonMark's Converter
 */
class Proxy implements Parser
{
	/**
	 * The markdown converter we're proxying
	 *
	 * @var CommonMark\MarkdownConverter
	 */
	protected $converter;


	/**
	 * Create a new instance
	 *
	 * @return void
	 */
	public function __construct(MarkdownConverter $converter)
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
