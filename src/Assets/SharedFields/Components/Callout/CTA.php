<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Callout;

use Edu\IU\RSB\StructuredDataNodes\Asset\LinkableNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class CTA implements ComponentInterface{
    use ComponentTraits;

    //content
    public string $text;
    public string $linkId;
    public string $linkPath;
    public string $linkType;
    public string $linkParameters;
    //identifiers
    public readonly string $identifierText;
    public readonly string $identifierLink;
    public readonly string $identifierLinkParameters;

    //nodes
    public TextInputNode $nodeText;
    public LinkableNode $nodeLink;
    public TextInputNode $nodeLinkParameters;

    public function __construct(string $text = '', string $linkId = '', string $linkPath = '', string $linkType = '', string $linkParameters = '')
    {
        $this->text = $text;
        $this->linkId = $linkId;
        $this->linkPath = $linkPath;
        $this->linkType = $linkType;
        $this->linkParameters = $linkParameters;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeText);
        $groupNode->addChild($this->nodeLink);
        $groupNode->addChild($this->nodeLinkParameters);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeText = new TextInputNode($this->identifierText, $this->text);
        $this->nodeLink = new LinkableNode($this->identifierLink, $this->linkId, $this->linkPath, $this->linkType);
        $this->nodeLinkParameters = new TextInputNode($this->identifierLinkParameters, $this->linkParameters);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'cta';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierText = 'text';
        $this->identifierLink = 'link';
        $this->identifierLinkParameters = 'link-parameters';
    }
}
