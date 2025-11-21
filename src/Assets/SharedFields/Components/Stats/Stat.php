<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Stats;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class Stat implements ComponentInterface{
    use ComponentTraits;

    //content
    public string $sticker;
    public string $number;
    public string $text;

    //identifiers
    public readonly string $identifierSticker;
    public readonly string $identifierNumber;
    public readonly string $identifierText;

    //nodes
    public TextInputNode $nodeSticker;
    public TextInputNode $nodeNumber;
    public TextInputNode $nodeText;

    public function __construct(string $sticker = '', string $number = '', string $text = '')
    {
        $this->sticker = $sticker;
        $this->number = $number;
        $this->text = $text;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeSticker);
        $groupNode->addChild($this->nodeNumber);
        $groupNode->addChild($this->nodeText);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeSticker = new TextInputNode($this->identifierSticker, $this->sticker);
        $this->nodeNumber = new TextInputNode($this->identifierNumber, $this->number);
        $this->nodeText = new TextInputNode($this->identifierText, $this->text);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'stat';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierSticker = 'sticker';
        $this->identifierNumber = 'number';
        $this->identifierText = 'text';
    }
}