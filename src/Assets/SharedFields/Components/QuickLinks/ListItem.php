<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks;


use Edu\IU\RSB\StructuredDataNodes\Asset\LinkableNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class ListItem implements ComponentInterface{
    use ComponentTraits;
    //content
    public string $listItemText;
    public string $listItemLinkId;
    public string $listItemLinkPath;
    public string $listItemLinkType;
    public string $listItemEyebrow;
    public string $listItemDescription;
    public string $listItemLinkParameters;

    //identifiers
    public readonly string $identifierListItemText;
    public readonly string $identifierListItemLink;
    public readonly string $identifierListItemEyebrow;
    public readonly string $identifierListItemDescription;
    public readonly string $identifierListItemLinkParameters;

    //nodes
    public TextInputNode $nodeListItemText;
    public LinkableNode $nodeListItemLink;
    public TextInputNode $nodeListItemEyebrow;
    public WysiwygNode $nodeListItemDescription;
    public TextInputNode $nodeListItemLinkParameters;

    public function __construct(
        string $listItemText = '',
        string $listItemLinkId = '',
        string $listItemLinkPath = '',
        string $listItemLinkType = '',
        string $listItemEyebrow = '',
        string $listItemDescription = '',
        string $listItemLinkParameters = '')
    {
        $this->listItemText = $listItemText;
        $this->listItemLinkId = $listItemLinkId;
        $this->listItemLinkPath = $listItemLinkPath;
        $this->listItemLinkType = $listItemLinkType;
        $this->listItemEyebrow = $listItemEyebrow;
        $this->listItemDescription = $listItemDescription;
        $this->listItemLinkParameters = $listItemLinkParameters;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeListItemText);
        $groupNode->addChild($this->nodeListItemLink);
        $groupNode->addChild($this->nodeListItemEyebrow);
        $groupNode->addChild($this->nodeListItemDescription);
        $groupNode->addChild($this->nodeListItemLinkParameters);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeListItemText = new TextInputNode($this->identifierListItemText, $this->listItemText);
        $this->nodeListItemLink = new LinkableNode($this->identifierListItemLink, $this->listItemLinkId, $this->listItemLinkPath, $this->listItemLinkType);
        $this->nodeListItemEyebrow = new TextInputNode($this->identifierListItemEyebrow, $this->listItemEyebrow);
        $this->nodeListItemDescription = new WysiwygNode($this->identifierListItemDescription, $this->listItemDescription);
        $this->nodeListItemLinkParameters = new TextInputNode($this->identifierListItemLinkParameters, $this->listItemLinkParameters);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'list-item';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierListItemText = 'list-item-text';
        $this->identifierListItemLink = 'list-item-link';
        $this->identifierListItemEyebrow = 'list-item-eyebrow';
        $this->identifierListItemDescription = 'list-item-description';
        $this->identifierListItemLinkParameters = 'list-item-link-parameters';
    }
}