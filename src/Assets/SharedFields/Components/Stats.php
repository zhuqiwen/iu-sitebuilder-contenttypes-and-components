<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use unit\BaseTest;

class Stats implements ComponentInterface{

    use ComponentTraits;

    //content
    public array $statArray;
    public string $note;
    public string $htmlId;

    //identifiers
    public readonly string $identifierGroupStat;
    public readonly string $identifierStatSticker;
    public readonly string $identifierStatNumber;
    public readonly string $identifierStatText;
    public readonly string $identifierNote;
    public readonly string $identifierHtmlId;


    //nodes
    /**
     * @var array of GroupNode with identifier = 'stat'
     */
    public array $groupNodeStatArray;
    public TextInputNode $nodeNote;
    public TextInputNode $nodeHtmlId;

    public function __construct(array $statArray = [], string $note = '', string $htmlId = '')
    {
        $this->setGroupIdentifier();
        $this->setChildrenIdentifiers();

        $this->statArray = $statArray;
        $this->note = $note;
        $this->htmlId = $htmlId;

        $this->constructChildrenNodes();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        foreach ($this->groupNodeStatArray as $groupNodeStat) {
            $groupNode->addChild($groupNodeStat);
        }
        $groupNode->addChild($this->nodeNote);
        $groupNode->addChild($this->nodeHtmlId);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeNote = new TextInputNode($this->identifierNote, $this->note);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);

        $this->groupNodeStatArray = [];
        foreach ($this->statArray as $stat) {
            $nodeStat = new GroupNode($this->identifierGroupStat);
            $nodeStat->addChild(new TextInputNode($this->identifierStatSticker, $stat['sticker'] ?? 'Sticker Not Set'));
            $nodeStat->addChild(new TextInputNode($this->identifierStatNumber, $stat['number'] ?? 'Number Not Set'));
            $nodeStat->addChild(new TextInputNode($this->identifierStatText, $stat['text'] ?? 'Label Not Set'));

            $this->groupNodeStatArray[] = $nodeStat;
        }
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'stats';

    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierGroupStat = 'stat';
        $this->identifierStatSticker = 'sticker';
        $this->identifierStatNumber = 'number';
        $this->identifierStatText = 'text';
        $this->identifierNote = 'note';
        $this->identifierHtmlId = 'id';
    }
}
