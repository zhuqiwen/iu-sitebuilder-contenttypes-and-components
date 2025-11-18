<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Image;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class ImageHubSmallImage implements ComponentInterface{

    use ComponentTraits;
    //content;
    public string $smallImage1Id;
    public string $smallImage1Path;
    public string $smallImage1Alt;
    public string $smallImage2Id;
    public string $smallImage2Path;
    public string $smallImage2Alt;
    //identifiers
    public readonly string $identifierSmallImage1;
    public readonly string $identifierSmallImage2;
    public readonly string $identifierSmallImage1Alt;
    public readonly string $identifierSmallImage2Alt;

    //nodes
    public FileNode $nodeSmallImage1;
    public FileNode $nodeSmallImage2;
    public TextInputNode $nodeSmallImage1Alt;
    public TextInputNode $nodeSmallImage2Alt;


    public function __construct(string $smallImage1Id = '', string $smallImage1Path = '', string $smallImage1Alt = '', string $smallImage2Id = '', string $smallImage2Path = '', string $smallImage2Alt = '')
    {
        $this->smallImage1Id = $smallImage1Id;
        $this->smallImage1Path = $smallImage1Path;
        $this->smallImage1Alt = $smallImage1Alt;
        $this->smallImage2Id = $smallImage2Id;
        $this->smallImage2Path = $smallImage2Path;
        $this->smallImage2Alt = $smallImage2Alt;

        $this->finishConstructor();
    }



    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeSmallImage1);
        $groupNode->addChild($this->nodeSmallImage1Alt);
        $groupNode->addChild($this->nodeSmallImage2);
        $groupNode->addChild($this->nodeSmallImage2Alt);

        return $groupNode;

    }

    public function constructChildrenNodes(): void
    {
        $this->nodeSmallImage1 = new FileNode($this->identifierSmallImage1, $this->smallImage1Id, $this->smallImage1Path);
        $this->nodeSmallImage2 = new FileNode($this->identifierSmallImage2, $this->smallImage2Id, $this->smallImage2Path);
        $this->nodeSmallImage1Alt = new TextInputNode($this->identifierSmallImage1Alt, $this->smallImage1Alt);
        $this->nodeSmallImage2Alt = new TextInputNode($this->identifierSmallImage2Alt, $this->smallImage2Alt);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'small-images';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierSmallImage1 = 'small-image-1';
        $this->identifierSmallImage2 = 'small-image-2';
        $this->identifierSmallImage1Alt = 'small-image-1-alt';
        $this->identifierSmallImage2Alt = 'small-image-2-alt';
    }
}