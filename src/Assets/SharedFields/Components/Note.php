<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;

class Note implements ComponentInterface{

    use ComponentTraits;
    // content
    public string $noteContent;
    //identifiers
    public string $identifierNoteContent;

    //nodes
    public WysiwygNode $nodeNoteContent;


    public function __construct(string $noteContent = '')
    {
        $this->noteContent = $noteContent;
        $this->finishConstructor();
    }

    /**
     * @return GroupNode
     */
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeNoteContent);

        return $groupNode;
    }

    /**
     * @return void
     */
    public function constructChildrenNodes(): void
    {
        $this->nodeNoteContent = new WysiwygNode($this->identifierNoteContent, $this->noteContent);
    }

    /**
     * @return void
     */
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'note';
    }

    /**
     * @return void
     */
    public function setChildrenIdentifiers(): void
    {
        $this->identifierNoteContent = 'note-content';
    }
}
