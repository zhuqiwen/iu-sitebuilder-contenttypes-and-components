<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Image;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class SingleImage implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $largeImageId;
    public string $largeImagePath;
    public string $smallImageId;
    public string $smallImagePath;
    public string $alt;

    //identifiers
    public readonly string $identifierLargeImage;
    public readonly string $identifierSmallImage;
    public readonly string $identifierAlt;

    //nodes
    public FileNode $nodeLargeImage;
    public FileNode $nodeSmallImage;
    public TextInputNode $nodeAlt;

    public function __construct(string $largeImageId = '', string $largeImagePath = '', string $smallImageId = '', string $smallImagePath = '', string $alt = '')
    {
        $this->largeImageId = $largeImageId;
        $this->largeImagePath = $largeImagePath;
        $this->smallImageId = $smallImageId;
        $this->smallImagePath = $smallImagePath;
        $this->alt = $alt;

        $this->finishConstructor();
    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeLargeImage);
        $groupNode->addChild($this->nodeSmallImage);
        $groupNode->addChild($this->nodeAlt);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeLargeImage = new FileNode($this->identifierLargeImage, $this->largeImageId, $this->largeImagePath);
        $this->nodeSmallImage = new FileNode($this->identifierSmallImage, $this->smallImageId, $this->smallImagePath);
        $this->nodeAlt = new TextInputNode($this->identifierAlt, $this->alt);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'single-image';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierLargeImage = 'image-large';
        $this->identifierSmallImage = 'image-small';
        $this->identifierAlt = 'alt';
    }
}
