<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;


/**
 * this class assumes there is only one file chooser for code snippet component
 */
class CodeSnippet implements ComponentInterface{

    use ComponentTraits;

    //content
    public readonly string $codeFileId;
    public readonly string $codeFilePath;


    //child identifiers
    public readonly string $identifierCodeFile;
    // child nodes
    public FileNode $nodeCodeFile;


    public function __construct(string $fileId = '', string $filePath = '')
    {
        $this->setGroupIdentifier();
        $this->setChildrenIdentifiers();

        $this->codeFileId = $fileId;
        $this->codeFilePath = $filePath;

        $this->constructChildrenNodes();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeCodeFile);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeCodeFile = new FileNode($this->identifierCodeFile, $this->codeFileId, $this->codeFilePath);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'code-snippet';
    }


    public function setChildrenIdentifiers(): void
    {
        $this->identifierCodeFile = 'code-file';
    }
}
