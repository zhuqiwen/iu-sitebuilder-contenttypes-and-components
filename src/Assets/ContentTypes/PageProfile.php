<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;



use Edu\IU\Framework\GenericUpdater\Asset\Foldered\Page;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;

class PageProfile implements ContentTypeInterface, ContentPageInterface{
    use ContentTypeTraits;

    public function constructPageContentGroupNode(): GroupNode
    {
        // TODO: Implement constructPageContentGroupNode() method.
    }

    public function constructHeroGroupNode(): GroupNode
    {
        // TODO: Implement constructHeroGroupNode() method.
    }

    public function constructPageSettingsGroupNode(): GroupNode
    {
        // TODO: Implement constructPageSettingsGroupNode() method.
    }

    public function createPage(): Page
    {
        // TODO: Implement createPage() method.
    }

    public function constructNewAsset(): \stdClass
    {
        // TODO: Implement constructNewAsset() method.
    }
}