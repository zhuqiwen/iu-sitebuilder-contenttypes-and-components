<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;

use Edu\IU\Framework\GenericUpdater\Asset\Foldered\Page;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Logger;
use Edu\IU\Wcms\WebService\WCMSClient;

trait ContentTypeTraits{

    public string $pageName;
    public string $pageParentFolderPath;
    public string $contentTypePath;
    public string $commonSiteName;
    public string $linkRewriting = 'inherit';
    public WCMSClient $wcms;
    public Logger $logger;



    public function setPageNameAndParentFolderPath(string $pagePath): void
    {
        $pagePath = trim($pagePath, DIRECTORY_SEPARATOR);
        $pathArray = explode(DIRECTORY_SEPARATOR, $pagePath);
        $this->pageName = array_shift($pathArray);
        $this->pageParentFolderPath = empty($pathArray) ? DIRECTORY_SEPARATOR : implode(DIRECTORY_SEPARATOR, $pathArray);
    }


    public function getPathPath(): string
    {
        return trim($this->pageParentFolderPath, DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR
            . trim($this->pageName, DIRECTORY_SEPARATOR);
    }

    public function createPage(): Page
    {

        $page = new Page($this->wcms);

        try {
            $data = $this->constructNewAsset();
            $page->setNewAsset($data);
            $page->createAsset();
            $this->logger->recordNewlyCreatedAsset($this->getPathPath(), 'page');
        }catch (\Exception $exception){
            $msg = $this->getPathPath() . ' skipped: ' . $exception->getMessage();
            $this->logger->logSKip($msg);
        }

        return $page;
    }
}