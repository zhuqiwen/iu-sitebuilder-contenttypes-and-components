<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;



use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Interface\ContentPageInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Interface\ContentTypeInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits\ContentPageTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits\ContentTypeTraits;

class PageLanding extends ContentTypeAbstract implements ContentTypeInterface, ContentPageInterface{
    use ContentTypeTraits;
    use ContentPageTraits;




    public function setContentTypePath(): void
    {
        $this->contentTypePath = $this->commonSiteName . ':' . 'Page - Landing';
    }
}