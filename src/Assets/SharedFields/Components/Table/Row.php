<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Table;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class Row implements ComponentInterface{
    use ComponentTraits;

    //content
    public array $columnArray;

    //identifiers
    public readonly string $identifierColumn;
    //node

    public function __construct(array $columnArray = [])
    {
        $this->columnArray = $columnArray;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        foreach ($this->columnArray as $column) {
            $groupNode->addChild(new WysiwygNode($this->identifierColumn, $column));
        }

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {

    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'row';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierColumn = 'column';
    }
}
