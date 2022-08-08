<?php
namespace toward\towardsupport\widgets;

use toward\towardsupport\TowardSupport;

use Craft;
use craft\base\Widget;
use craft\widgets\Feed;

class NewsWidget extends Feed
{
	public $title = "Toward News";
	public $url = "https://toward.studio/feed.rss";

	/**
	 * @inheritdoc
	 */
	public static function displayName(): string
	{
		return Craft::t("app", "Toward News");
	}
}
