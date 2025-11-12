<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Logger;
use Edu\IU\Wcms\WebService\WCMSClient;

trait ContentPageTraits{

    public GroupNode $pageContentGroupNode;
    public GroupNode $pageSettingsGroupNode;
    public GroupNode $pageHeroGroupNode;
    public array $metadataArray;

}