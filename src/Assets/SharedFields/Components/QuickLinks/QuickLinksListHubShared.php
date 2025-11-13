<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\QuickLinks;

use Edu\IU\RSB\StructuredDataNodes\Asset\PageNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class QuickLinksListHubShared implements ComponentInterface, QuickLinksListHubInterface {
    use ComponentTraits;

    //content
    public string $type;
    public string $sharedListPageId;
    public string $sharedListPagePath;

    //identifiers
    public readonly string $identifierType;

    public readonly string $identifierSharedList;

    //nodes
    public PageNode $nodeSharedListPage;
    public DropdownNode $nodeType;


    public function __construct(string $sharedListPageId = '', string $sharedListPagePath = '')
    {
        $this->type = 'shared';
        $this->sharedListPageId = $sharedListPageId;
        $this->sharedListPagePath = $sharedListPagePath;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeType);
        $groupNode->addChild($this->nodeSharedListPage);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeSharedListPage = new PageNode($this->identifierSharedList, $this->sharedListPageId, $this->sharedListPagePath);
        $this->nodeType = new DropdownNode($this->identifierType, $this->type);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'list-hub';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierSharedList = 'shared-list';
        $this->identifierType = 'type';
    }
}