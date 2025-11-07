<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;

use Edu\IU\Framework\GenericUpdater\Asset\Foldered\Page;

interface ContentTypeInterface{

    public function createPage():Page;

    public function constructNewAsset():\stdClass;

}