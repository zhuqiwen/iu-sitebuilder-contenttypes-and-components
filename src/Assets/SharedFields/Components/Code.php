<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;

class Code implements ComponentInterface{

    use ComponentTraits;

    public string $title;
    public string $codeFileId;
    public string $codeFilePath;
    public readonly string $identifierTitle;
    public readonly string $identifierCodeFile;

    public TextInputNode $nodeTitle;
    public FileNode $nodeFile;


    public function __construct(string $title = '', string $codeFileId = '', string $codeFilePath = '')
    {
        $this->setGroupIdentifier();
        $this->setChildrenIdentifiers();

        $this->title = $title;
        $this->codeFileId = $codeFileId;
        $this->codeFilePath = $codeFilePath;

        $this->constructChildrenNodes();
    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeFile);
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeFile = new FileNode($this->identifierCodeFile, $this->codeFileId, $this->codeFilePath);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'code';
    }


    public function setChildrenIdentifiers(): void
    {
        $this->identifierTitle = 'name';
        $this->identifierCodeFile = 'code-file';
    }
}
