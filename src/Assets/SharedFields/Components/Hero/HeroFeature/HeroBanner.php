<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroFeature;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroStatement\BannerImage;
use function LaravelIdea\throw_if;

class HeroBanner extends BannerImage{

    public readonly string $groupIdentifier;
    //contents
    public string $caption;
    public string $showQuickLinks;
    public ?ListHub $listHub;
    public array $ctasArray;

    //identifiers
    public readonly string $identifierCaption;
    public readonly string $identifierShowQuickLinks;
    public readonly string $identifierImage;
    public readonly string $identifierSmallImage;

    //nodes
    public TextInputNode $nodeCaption;
    public CheckboxNode $nodeShowQuickLinks;


    public function __construct(string $imageId = '', string $imagePath = '', string $smallImageId = '', string $smallImagePath = '', string $alt = '', string $caption = '', string $showQuickLinks = '', ?ListHub $listHub = null)
    {

        $this->caption = $caption;
        $this->showQuickLinks = $showQuickLinks;
        $this->listHub = $listHub;

        parent::__construct($imageId, $imagePath, $smallImageId, $smallImagePath, $alt);

    }

    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = parent::constructComponentGroupNode();
        $groupNode->setValueIdentifier($this->groupIdentifier);
        $groupNode->addChild($this->nodeCaption);
        $groupNode->addChild($this->nodeShowQuickLinks);
        foreach ($this->ctasArray as $cta) {
            if ($cta instanceof CTA) {
                $groupNode->addChild($cta->constructComponentGroupNode());
            }
        }
        $groupNode->addChild($this->listHub->constructComponentGroupNode());

        return $groupNode;

    }

    public function constructChildrenNodes(): void
    {
        parent::constructChildrenNodes();
        $this->nodeCaption = new TextInputNode($this->identifierCaption, $this->caption);
        $this->nodeShowQuickLinks =  new CheckboxNode($this->identifierShowQuickLinks, [$this->showQuickLinks]);
    }

    public function setGroupIdentifier():void
    {
        $this->groupIdentifier = 'banner';
    }

    public function setChildrenIdentifiers():void
    {
        $this->identifierImage = 'banner-image';
        $this->identifierSmallImage = 'banner-image-small';
        $this->identifierCaption = 'caption';
        $this->identifierShowQuickLinks = 'show-quick-links';
    }


}