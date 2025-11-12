<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;

use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Logger;
use Edu\IU\Wcms\WebService\WCMSClient;

abstract class ContentTypeAbstract implements ContentTypeInterface{
    use ContentTypeTraits;
    public function __construct(WCMSClient $wcms, Logger $logger, string $pagePath)
    {
        $this->wcms = $wcms;
        $this->logger = $logger;
        $this->setPageNameAndParentFolderPath($pagePath);

    }



}