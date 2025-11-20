<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ListHub;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks\ListItem as QuickLinksListItem;

class ListItem extends QuickLinksListItem{

    //content
    public string $listItemBadge;
    //identifiers
    public readonly string $identifierListItemBadge;
    //nodes
    public TextInputNode $nodeListItemBadge;


    public function __construct(string $listItemText = '', string $listItemLinkId = '', string $listItemLinkPath = '', string $listItemLinkType = '', string $listItemEyebrow = '', string $listItemBadge = '', string $listItemDescription = '', string $listItemLinkParameters = '')
    {
        $this->listItemBadge = $listItemBadge;

        parent::__construct($listItemText, $listItemLinkId, $listItemLinkPath, $listItemLinkType, $listItemEyebrow, $listItemDescription, $listItemLinkParameters);

    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = parent::constructComponentGroupNode();
        $groupNode->addChild($this->nodeListItemBadge);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        parent::constructChildrenNodes();
        $this->nodeListItemBadge = new TextInputNode($this->identifierListItemBadge, $this->listItemBadge);

    }



    public function setChildrenIdentifiers(): void
    {
        parent::setChildrenIdentifiers();
        $this->identifierListItemBadge = 'list-item-badge';
    }

}