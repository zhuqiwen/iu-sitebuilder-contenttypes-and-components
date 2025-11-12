<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;



use Edu\IU\Framework\GenericUpdater\Asset\Foldered\Page;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Interface\ContentPageInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Interface\ContentTypeInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits\ContentTypeTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits\PageWithSideNavTraits;

class PageCardGrid implements ContentTypeInterface, ContentPageInterface {
    use ContentTypeTraits;
    use PageWithSideNavTraits;

    public function constructNewAsset(): \stdClass
    {
        // TODO: Implement constructNewAsset() method.
    }

    public function setChildrenNodeIdentifiers(): void
    {
        // TODO: Implement setChildrenNodeIdentifiers() method.
    }

    public function setContentTypePath(): void
    {
        // TODO: Implement setContentTypePath() method.
    }
}