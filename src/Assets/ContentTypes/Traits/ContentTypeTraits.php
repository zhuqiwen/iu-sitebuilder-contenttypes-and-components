<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits;

use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Logger;
use Edu\IU\Wcms\WebService\WCMSClient;

trait ContentTypeTraits{

    public string $pageName;
    public string $pageParentFolderPath;
    public string $contentTypePath;
    public string $commonSiteName;
    public string $linkRewriting = 'inherit';
    public WCMSClient $wcms;



    public function setPageNameAndParentFolderPath(string $pagePath): void
    {
        $pagePath = trim($pagePath, DIRECTORY_SEPARATOR);
        $pathArray = explode(DIRECTORY_SEPARATOR, $pagePath);
        $this->pageName = array_pop($pathArray);
        $this->pageParentFolderPath = empty($pathArray) ? DIRECTORY_SEPARATOR : implode(DIRECTORY_SEPARATOR, $pathArray);
    }


    public function getPathPath(): string
    {
        return trim($this->pageParentFolderPath, DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR
            . trim($this->pageName, DIRECTORY_SEPARATOR);
    }

}