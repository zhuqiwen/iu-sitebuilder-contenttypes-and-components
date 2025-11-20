<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Billboard;

use Edu\IU\RSB\StructuredDataNodes\Asset\LinkableNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class CTA implements ComponentInterface{
    use ComponentTraits;

    //content
    public string $label;
    public string $linkId;
    public string $linkPath;
    public string $linkType;

    //identifiers
    public readonly string $identifierLabel;
    public readonly string $identifierLink;

    //nodes
    public TextInputNode $nodeLabel;
    public LinkableNode $nodeLink;

    public function __construct(string $label = '', string $linkId = '', string $linkPath = '', string $linkType = '')
    {
        $this->label = $label;
        $this->linkId = $linkId;
        $this->linkPath = $linkPath;
        $this->linkType = $linkType;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeLabel);
        $groupNode->addChild($this->nodeLink);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeLabel = new TextInputNode($this->identifierLabel, $this->label);
        $this->nodeLink = new LinkableNode($this->identifierLink, $this->linkId, $this->linkPath, $this->linkType);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'cta';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierLabel = 'label';
        $this->identifierLink = 'link';
    }
}
