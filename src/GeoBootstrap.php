<?php

namespace B2\Theme;

class GeoBootstrap extends \B2\Theme\Bootstrap2
{
	var $layout_class = \B2\Theme\GeoBootstrap\Layout::class;

	function page_data()
	{
		return array_merge(parent::page_data(), [
			'pub' => '/components/bors-theme-geo-bootstrap/public',
		]);
	}
}
