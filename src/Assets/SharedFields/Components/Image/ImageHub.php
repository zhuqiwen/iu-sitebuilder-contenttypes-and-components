<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Image;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\RadioNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;

class ImageHub implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $teaser;
    public string $largeImageOrientation;
    public string $horizontalPlacement;
    public string $verticalPlacement;
    public ImageHubLargeImage $largeImage;
    public ImageHubSmallImage $smallImage;

    //identifiers
    public readonly string $identifierTeaser;
    public readonly string $identifierLargeImageOrientation;
    public readonly string $identifierHorizontalPlacement;
    public readonly string $identifierVerticalPlacement;

    //nodes
    public TextInputNode $nodeTeaser;
    public RadioNode $nodeLargeImageOrientation;
    public RadioNode $nodeHorizontalPlacement;
    public RadioNode $nodeVerticalPlacement;

    public function __construct(string $teaser = '',string $largeImageOrientation = '', string $horizontalPlacement = '', string $verticalPlacement = '', ImageHubLargeImage | null $largeImage = null, ImageHubSmallImage | null $smallImage = null)
    {
        $this->teaser = $teaser;
        $this->largeImageOrientation = $largeImageOrientation;
        $this->horizontalPlacement = $horizontalPlacement;
        $this->verticalPlacement = $verticalPlacement;
        $this->largeImage = $largeImage;
        $this->smallImage = $smallImage;
        $this->finishConstructor();
    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeTeaser);
        $groupNode->addChild($this->nodeLargeImageOrientation);
        $groupNode->addChild($this->nodeHorizontalPlacement);
        $groupNode->addChild($this->nodeVerticalPlacement);
        $groupNode->addChild($this->largeImage->constructComponentGroupNode());
        $groupNode->addChild($this->smallImage->constructComponentGroupNode());

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeTeaser = new TextInputNode($this->identifierTeaser, $this->teaser);
        $this->nodeLargeImageOrientation = new RadioNode($this->identifierLargeImageOrientation, $this->largeImageOrientation);
        $this->nodeHorizontalPlacement = new RadioNode($this->identifierHorizontalPlacement, $this->horizontalPlacement);
        $this->nodeVerticalPlacement = new RadioNode($this->identifierVerticalPlacement, $this->verticalPlacement);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'image-hub';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierTeaser = 'teaser';
        $this->identifierLargeImageOrientation = 'large-image-orientation';
        $this->identifierHorizontalPlacement = 'horizontal-placement';
        $this->identifierVerticalPlacement = 'vertical-placement';
    }
}