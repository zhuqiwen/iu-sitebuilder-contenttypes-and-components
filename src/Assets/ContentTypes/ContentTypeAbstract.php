<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;

use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Interface\ContentTypeInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits\ContentTypeTraits;
use Edu\IU\Wcms\WebService\WCMSClient;

abstract class ContentTypeAbstract implements ContentTypeInterface{
    use ContentTypeTraits;
    public function __construct(WCMSClient $wcms, string $pagePath)
    {
        $this->wcms = $wcms;
        $this->setPageNameAndParentFolderPath($pagePath);
        $this->commonSiteName = 'IU-BUILDER.common';

    }



}