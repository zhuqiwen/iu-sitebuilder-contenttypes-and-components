<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;

class Quote implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $quotation;
    public string $source;
    public string $subtitle;
    public string $avatarId;
    public string $avatarPath;

    //identifiers
    public readonly string $identifierQuotation;
    public readonly string $identifierSource;
    public readonly string $identifierSubtitle;
    public readonly string $identifierAvatar;

    //nodes
    public TextInputNode $nodeQuotation;
    public TextInputNode $nodeSource;
    public TextInputNode $nodeSubtitle;
    public FileNode $nodeAvatar;

    public function __construct(string $quotation = '', string $source = '', string $subtitle = '', string $avatarId = '', string $avatarPath = '')
    {
        // sitebuilder quotation accepts pure string, no html tags
        $this->quotation = html_entity_decode(strip_tags($quotation), ENT_QUOTES, 'UTF-8');
        $this->source = $source;
        $this->subtitle = $subtitle;
        $this->avatarId = $avatarId;
        $this->avatarPath = $avatarPath;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeQuotation);
        $groupNode->addChild($this->nodeSource);
        $groupNode->addChild($this->nodeSubtitle);
        $groupNode->addChild($this->nodeAvatar);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeQuotation = new TextInputNode($this->identifierQuotation, $this->quotation);
        $this->nodeSource = new TextInputNode($this->identifierSource, $this->source);
        $this->nodeSubtitle = new TextInputNode($this->identifierSubtitle, $this->subtitle);
        $this->nodeAvatar = new FileNode($this->identifierAvatar, $this->avatarId, $this->avatarPath);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'quote';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierQuotation = 'quotation';
        $this->identifierSource = 'source';
        $this->identifierSubtitle = 'subtitle';
        $this->identifierAvatar = 'avatar';
    }

    public function html2String(string $html): string
    {

    }
}
