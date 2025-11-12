<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;



use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Interface\ContentPageInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Interface\PageWithSideNavInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits\ContentPageTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits\ContentTypeTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits\PageWithSideNavTraits;

class PageDetails extends ContentTypeAbstract implements ContentPageInterface, PageWithSideNavInterface {
    use ContentTypeTraits;
    use ContentPageTraits;
    use PageWithSideNavTraits;




    public function setContentTypePath(): void
    {
        $this->contentTypePath = $this->commonSiteName . ':' . 'Page - Details';
    }





}