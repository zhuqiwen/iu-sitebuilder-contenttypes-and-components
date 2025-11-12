<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Interface;

interface ContentTypeInterface{


    public function constructNewAsset():\stdClass;

    public function setChildrenNodeIdentifiers(): void;
    public function setContentTypePath(): void;
    public function setPageNameAndParentFolderPath(string $pagePath): void;

    public function getPathPath():string;

}