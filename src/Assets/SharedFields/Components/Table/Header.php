<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Table;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class Header implements ComponentInterface{
    use ComponentTraits;
    //content
    public array $headerTextArray;

    //identifiers
    public readonly string $identifierHeader;

    //nodes


    public function __construct(array $headerTextArray = [])
    {
        $this->headerTextArray = $headerTextArray;
        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        foreach($this->headerTextArray as $headerText){
            $groupNode->addChild(new TextInputNode($this->identifierHeader, $headerText));
        }

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {

    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'header';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierHeader = 'header';
    }
}
