<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks;

use Edu\IU\RSB\StructuredDataNodes\Asset\PageNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class QuickLinksListHubPageSpecific implements ComponentInterface, QuickLinksListHubInterface {
    use ComponentTraits;

    //content
    public string $type;
    public string $title;
    public array $listItemsArray;
    public string $headingLevel;

    //identifiers
    public readonly string $identifierType;
    public readonly string $identifierTitle;
    public readonly string $identifierHeadingLevel;

    //nodes
    public DropdownNode $nodeType;
    public TextInputNode $nodeTitle;
    public DropdownNode $nodeHeadingLevel;


    public function __construct(string $title = '', string $headingLevel = 'h2', array $quickLinksListItemObjsArray = [])
    {
        $this->type = 'manual';
        $this->title = $title;
        $this->headingLevel = $headingLevel;
        $this->listItemsArray = $quickLinksListItemObjsArray;

        $this->finishConstructor();
    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeType);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeHeadingLevel);
        foreach($this->listItemsArray as $listItem){
            if (get_class($listItem) === ListItem::class){
                $groupNode->addChild($listItem->constructComponentGroupNode());
            }

        }

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeType = new DropdownNode($this->identifierType, $this->type);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
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
    }
}
