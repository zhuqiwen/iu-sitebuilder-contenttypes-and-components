<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser\Cards;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser\SectionIntro;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser\Feed;

class CardTeaserManualCards implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $source;
    public SectionIntro $sectionIntro;
    public Cards $cards;
    public string $htmlId;
    //identifiers
    public readonly string $identifierSource;
    public readonly string $identifierHtmlId;

    //nodes
    public DropdownNode $nodeSource;
    public TextInputNode $nodeHtmlId;


    public function __construct(SectionIntro $sectionIntro, Cards $cards, string $htmlId = '')
    {
        $this->source = 'cards';
        $this->sectionIntro = $sectionIntro;
        $this->cards = $cards;
        $this->htmlId = $htmlId;
        $this->finishConstructor();
    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeSource);
        $groupNode->addChild($this->sectionIntro->constructComponentGroupNode());
        $groupNode->addChild($this->cards->constructComponentGroupNode());
        $groupNode->addChild($this->nodeHtmlId);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeSource = new DropdownNode($this->identifierSource, $this->source);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'card-teaser';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierSource = 'sources';
        $this->identifierHtmlId = 'id';
    }
}
