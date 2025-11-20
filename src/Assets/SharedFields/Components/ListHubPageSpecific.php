<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ListHub\ListItem;

class ListHubPageSpecific implements ComponentInterface{

    use ComponentTraits;
    //content
    public string $type;
    public string $title;
    public array $listItemsArray;
    public string $headingLevel;
    public string $htmlId;

    //identifiers
    public readonly string $identifierType;
    public readonly string $identifierTitle;
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierHtmlId;


    //nodes
    public DropdownNode $nodeType;
    public TextInputNode $nodeTitle;
    public DropdownNode $nodeHeadingLevel;
    public TextInputNode $nodeHtmlId;

    public function __construct(string $title = '', array $listItemsArray = [], string $headingLevel = '', string $htmlId = '',)
    {
        $this->type = 'manual';
        $this->title = $title;
        $this->listItemsArray = $listItemsArray;
        $this->headingLevel = $headingLevel;
        $this->htmlId = $htmlId;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeType);
        $groupNode->addChild($this->nodeTitle);
        foreach ($this->listItemsArray as $listItem) {
            if ($listItem instanceof ListItem) {
                $groupNode->addChild($listItem->constructComponentGroupNode());
            }
        }
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeHtmlId);

        return $groupNode;

    }

    public function constructChildrenNodes(): void
    {
        $this->nodeType = new DropdownNode($this->identifierType, $this->type);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'list-hub';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierType = 'type';
        $this->identifierTitle = 'title';
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierHtmlId = 'id';
    }
}
