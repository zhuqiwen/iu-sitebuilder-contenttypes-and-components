<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser\Cards;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser\SectionIntro;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser\Feed;

class CardTeaserFeed extends CardTeaserManualCards implements ComponentInterface{

    use ComponentTraits;

    //content
    public Feed $feed;
    //identifiers

    //nodes

    public function __construct(SectionIntro $sectionIntro, Feed $feed, string $htmlId = '')
    {
        $this->source = 'cards';
        $this->sectionIntro = $sectionIntro;
        $this->feed = $feed;
        $this->htmlId = $htmlId;
        $this->finishConstructor();
    }
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = parent::constructComponentGroupNode();
        $groupNode->addChild($this->feed->constructComponentGroupNode());

        return $groupNode;
    }
}
