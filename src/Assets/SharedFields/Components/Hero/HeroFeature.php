<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;
class HeroFeature implements ComponentInterface, HeroInterface {

    use ComponentTraits;
    use HeroTraits;

    //content

    //identifiers

    //nodes

    public function constructComponentGroupNode(): GroupNode
    {
        // TODO: Implement constructComponentGroupNode() method.
    }

    public function constructChildrenNodes(): void
    {
        // TODO: Implement constructChildrenNodes() method.
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'hero-feature';
    }

    public function setChildrenIdentifiers(): void
    {
        // TODO: Implement setChildrenIdentifiers() method.
    }
}
