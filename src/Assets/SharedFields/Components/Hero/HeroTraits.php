<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;

trait HeroTraits{

    /**
     * @return GroupNode
     */
    public function constructHeroGroupNode(): GroupNode
    {
        $this->constructComponentGroupNode();
    }
}