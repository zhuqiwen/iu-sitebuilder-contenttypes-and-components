<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\CardTeaser;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class Cards implements ComponentInterface {

    use ComponentTraits;

    //content
    public array $cardObjsArray;

    //identifiers


    //nodes

    public function __construct(array $cards = [])
    {
        $this->cardObjsArray = $cards;
        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        foreach ($this->cardObjsArray as $card) {
            if ($card instanceof Card){
                $groupNode->addChild($card->constructComponentGroupNode());
            }
        }
        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        // leave it empty, because no other children nodes in this component
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'cards';
    }

    public function setChildrenIdentifiers(): void
    {
        // leave it empty, because no other children nodes in this component
    }
}
