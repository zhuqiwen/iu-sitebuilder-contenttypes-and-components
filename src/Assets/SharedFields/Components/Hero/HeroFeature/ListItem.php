<?php


namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroFeature;

use Edu\IU\RSB\StructuredDataNodes\Asset\LinkableNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroTraits;

class ListItem implements ComponentInterface, HeroInterface{

    use ComponentTraits;
    use HeroTraits;

    //contents
    public string $listItemText;
    public string $listItemLinkId;
    public string $listItemLinkPath;
    public string $listItemLinkType;
    public string $listItemLinkParameters;

    //identifiers
    public readonly string $identifierListItemText;
    public readonly string $identifierListItemLink;
    public readonly string $identifierListItemLinkParameters;

    //nodes
    public TextInputNode $nodeListItemText;
    public LinkableNode $nodeListItemLink;
    public TextInputNode $nodeListItemLinkParameters;

    public function __construct(string $listItemText = '', string $listItemLinkId = '', string $listItemLinkPath = '', string $listItemLinkType = '', string $listItemLinkParameters = '')
    {
        $this->listItemText = $listItemText;
        $this->listItemLinkId = $listItemLinkId;
        $this->listItemLinkPath = $listItemLinkPath;
        $this->listItemLinkType = $listItemLinkType;
        $this->listItemLinkParameters = $listItemLinkParameters;

        $this->finishConstructor();
    }

    /**
     * @return GroupNode
     */
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeListItemText);
        $groupNode->addChild($this->nodeListItemLink);
        $groupNode->addChild($this->nodeListItemLinkParameters);

        return $groupNode;
    }

    /**
     * @return void
     */
    public function constructChildrenNodes(): void
    {
        $this->nodeListItemText = new TextInputNode($this->identifierListItemText, $this->listItemText);
        $this->nodeListItemLink = new LinkableNode($this->identifierListItemLink, $this->listItemLinkId, $this->listItemLinkPath, $this->listItemLinkType);
        $this->nodeListItemLinkParameters = new TextInputNode($this->identifierListItemLinkParameters, $this->listItemLinkParameters);
    }

    /**
     * @return void
     */
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'list-item';
    }

    /**
     * @return void
     */
    public function setChildrenIdentifiers(): void
    {
        $this->identifierListItemText = 'list-item-text';
        $this->identifierListItemLink = 'list-item-link';
        $this->identifierListItemLinkParameters = 'list-item-link-parameters';
    }
}