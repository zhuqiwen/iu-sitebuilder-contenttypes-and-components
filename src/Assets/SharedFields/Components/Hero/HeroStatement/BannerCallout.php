<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroStatement;

use Edu\IU\RSB\StructuredDataNodes\Asset\LinkableNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextAreaNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class BannerCallout implements ComponentInterface{
    use ComponentTraits;

    //content
    public string $eyebrow;
    public string $text;
    public string $linkId;
    public string $linkPath;
    public string $linkType;
    public string $linkParameters;
    public string $stickerId;

    //identifiers
    public readonly string $identifierEyebrow;
    public readonly string $identifierText;
    public readonly string $identifierLink;
    public readonly string $identifierLinkParameters;
    public readonly string $identifierStickerId;

    //nodes
    public TextInputNode $nodeEyebrow;
    public TextAreaNode $nodeText;
    public LinkableNode $nodeLink;
    public TextInputNode $nodeLinkParameters;
    public TextInputNode $nodeStickerId;

    public function __construct(string $eyebrow = '', string $text = '', string $linkId = '', string $linkPath = '', string $linkType = '', string $linkParameters = '', string $stickerId = '')
    {
        $this->eyebrow = $eyebrow;
        $this->text = $text;
        $this->linkId = $linkId;
        $this->linkPath = $linkPath;
        $this->linkType = $linkType;
        $this->linkParameters = $linkParameters;
        $this->stickerId = $stickerId;
        $this->finishConstructor();
    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeText);
        $groupNode->addChild($this->nodeLink);
        $groupNode->addChild($this->nodeLinkParameters);
        $groupNode->addChild($this->nodeStickerId);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeText = new TextAreaNode($this->identifierText, $this->text);
        $this->nodeLink = new LinkableNode($this->identifierLink, $this->linkId, $this->linkPath, $this->linkType);
        $this->nodeLinkParameters = new TextInputNode($this->identifierLinkParameters, $this->linkParameters);
        $this->nodeStickerId = new TextInputNode($this->identifierStickerId, $this->stickerId);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'banner-callout';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierText = 'text';
        $this->identifierLink = 'link';
        $this->identifierLinkParameters = 'link-parameters';
        $this->identifierStickerId = 'sticker-id';
    }
}
