<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\Asset\SymlinkNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;

class Feed implements ComponentInterface{

    use ComponentTraits;
    //content
    public string $feedLinkId;
    public string $feedLinkPath;
    public string $feedMax;

    //identifiers
    public readonly string $identifierFeedLink;
    public readonly string $identifierFeedMax;

    //nodes
    public SymlinkNode $nodeFeedLink;
    public DropdownNode $nodeFeedMax;

    public function __construct(string $feedLinkId = '', string $feedLinkPath = '', string $feedMax = 'automatic')
    {
        $this->setGroupIdentifier();
        $this->setChildrenIdentifiers();

        $this->feedLinkId = $feedLinkId;
        $this->feedLinkPath = $feedLinkPath;
        $this->feedMax = $feedMax;

        $this->constructChildrenNodes();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeFeedLink);
        $groupNode->addChild($this->nodeFeedMax);
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeFeedLink = new SymlinkNode($this->identifierFeedLink, $this->feedLinkId, $this->feedLinkPath);
        $this->nodeFeedMax = new DropdownNode($this->identifierFeedMax, $this->feedMax);
    }

    public function setGroupIdentifier(): void
    {

        $this->groupIdentifier = 'feeds';
    }



    public function setChildrenIdentifiers(): void
    {
        $this->identifierFeedLink = 'feed-link';
        $this->identifierFeedMax = 'feed-max';
    }
}
