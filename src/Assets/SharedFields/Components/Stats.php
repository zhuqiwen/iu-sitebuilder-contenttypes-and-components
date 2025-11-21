<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Stats\Stat;
use unit\BaseTest;

class Stats implements ComponentInterface{

    use ComponentTraits;

    //content
    public array $statArray;
    public string $note;
    public string $htmlId;

    //identifiers

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


        $this->statArray = $statArray;
        $this->note = $note;
        $this->htmlId = $htmlId;

        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        foreach ($this->statArray as $stat) {
            if ($stat instanceof Stat){
                $groupNode->addChild($stat->constructComponentGroupNode());
            }
        }
        $groupNode->addChild($this->nodeNote);
        $groupNode->addChild($this->nodeHtmlId);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeNote = new TextInputNode($this->identifierNote, $this->note);
        $this->nodeHtmlId = new TextInputNode($this->identifierHtmlId, $this->htmlId);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'stats';

    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierNote = 'note';
        $this->identifierHtmlId = 'id';
    }
}
