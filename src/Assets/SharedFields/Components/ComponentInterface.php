<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;

interface ComponentInterface{


    public function constructComponentGroupNode():GroupNode;

    public function constructChildrenNodes():void;

    public function setGroupIdentifier(): void;

    public function getGroupIdentifier(): string;

    public function setChildrenIdentifiers(): void  ;
    
    
    
}
