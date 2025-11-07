<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;

interface ContentPageInterface{

    public function constructPageContentGroupNode():GroupNode;

    public function constructHeroGroupNode():GroupNode;

    public function constructPageSettingsGroupNode(): GroupNode;

}