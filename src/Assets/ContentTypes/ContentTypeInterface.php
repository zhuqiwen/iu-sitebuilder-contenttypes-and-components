<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;

use Edu\IU\Framework\GenericUpdater\Asset\Foldered\Page;

interface ContentTypeInterface{


    public function constructNewAsset():\stdClass;

    public function setChildrenNodeIdentifiers(): void;
    public function setContentTypePath(): void;
    public function setPageNameAndParentFolderPath(string $pagePath): void;

    public function getPathPath():string;

}