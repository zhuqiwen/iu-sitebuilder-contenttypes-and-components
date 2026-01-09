<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;

interface HeroInterface{


    public function constructHeroGroupNode():GroupNode;
}