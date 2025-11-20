<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Billboard;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\Asset\LinkableNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class Media implements ComponentInterface{
    use ComponentTraits;

    //content
    public string $imageId;
    public string $imagePath;
    public string $alt;
    //identifiers
    public readonly string $identifierImage;
    public readonly string $identifierAlt;
    //nodes
    public FileNode $nodeImage;
    public TextInputNode $nodeAlt;

    public function __construct(string $imageId = '', string $imagePath = '', string $alt = '')
    {
        $this->imageId = $imageId;
        $this->imagePath = $imagePath;
        $this->alt = $alt;
        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeImage);
        $groupNode->addChild($this->nodeAlt);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeImage = new FileNode($this->identifierImage, $this->imageId, $this->imagePath);
        $this->nodeAlt = new TextInputNode($this->identifierAlt, $this->alt);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'media';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierImage = 'image';
        $this->identifierAlt = 'alt';
    }
}