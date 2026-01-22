<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroProfile\CTA;


class HeroProfile implements ComponentInterface, HeroInterface {

    use ComponentTraits;
    use HeroTraits;

    //content
    public readonly string $eyebrow;
    public readonly string $name;
    public readonly string $jobTitle;
    public readonly string $description;
    public readonly string $imageId;
    public readonly string $imagePath;
    public readonly string $imageAlt;
    public readonly string $showCTAs;

    public array $CTAsArray;

    //identifiers
    public readonly string $identifierEyebrow;
    public readonly string $identifierName;
    public readonly string $identifierJobTitle;
    public readonly string $identifierDescription;
    public readonly string $identifierImage;
    public readonly string $identifierImageAlt;
    public readonly string $identifierShowCTAs;

    //nodes

    public TextInputNode $nodeEyebrow;
    public TextInputNode $nodeName;
    public TextInputNode $nodeJobTitle;
    public TextInputNode $nodeDescription;
    public FileNode $nodeImage;
    public TextInputNode $nodeImageAlt;
    public CheckboxNode $nodeShowCTAs;



    public function __construct(string $eyebrow = '', string $name = '', string $jobTitle = '', string $description = '', string $imageId = '', string $imagePath = '', string $imageAlt = '', string $showCTAs = '', array $CTAsArray = [])
    {
        $this->eyebrow = $eyebrow;
        $this->name = $name;
        $this->jobTitle = $jobTitle;
        $this->description = $description;
        $this->imageId = $imageId;
        $this->imagePath = $imagePath;
        $this->imageAlt = $imageAlt;
        $this->showCTAs = $showCTAs;
        $this->CTAsArray = $CTAsArray;

        $this->finishConstructor();
    }


    /**
     * @return GroupNode
     */
    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeEyebrow);
        $groupNode->addChild($this->nodeName);
        $groupNode->addChild($this->nodeJobTitle);
        $groupNode->addChild($this->nodeDescription);
        $groupNode->addChild($this->nodeImage);
        $groupNode->addChild($this->nodeImageAlt);
        $groupNode->addChild($this->nodeShowCTAs);
        foreach ($this->CTAsArray as $CTA) {
            if ($CTA instanceof CTA){
                $groupNode->addChild($CTA->constructComponentGroupNode());
            }
        }

        return $groupNode;
    }

    /**
     * @return void
     */
    public function constructChildrenNodes(): void
    {
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeName = new TextInputNode($this->identifierName, $this->name);
        $this->nodeJobTitle = new TextInputNode($this->identifierJobTitle, $this->jobTitle);
        $this->nodeDescription = new TextInputNode($this->identifierDescription, $this->description);
        $this->nodeImage = new FileNode($this->identifierImage, $this->imageId, $this->imagePath);
        $this->nodeImageAlt = new TextInputNode($this->identifierImageAlt, $this->imageAlt);
        $this->nodeShowCTAs = new CheckboxNode($this->identifierShowCTAs, [$this->showCTAs]);
    }

    /**
     * @return void
     */
    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'hero';
    }

    /**
     * @return void
     */
    public function setChildrenIdentifiers(): void
    {
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierName = 'name';
        $this->identifierJobTitle = 'job-title';
        $this->identifierDescription = 'description';
        $this->identifierImage = 'image';
        $this->identifierImageAlt = 'alt';
        $this->identifierShowCTAs = 'show-ctas';

    }
}
