<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero;


use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\CheckboxNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentInterface;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\ComponentTraits;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroStatement\BannerCallout;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroStatement\BannerImage;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components\Hero\HeroStatement\CTA;

class HeroStatement implements ComponentInterface,HeroInterface {

    use ComponentTraits;
    use HeroTraits;

    //content
    public string $eyebrow;
    public string $title;
    public string $teaser;
    public string $showCTAs;

    public string $showBannerImages;
    public string $showBannerCallout;

    public BannerCallout $bannerCallout;
    public array $bannerImageObjArray;
    public array $ctaObjArray;


    //identifiers
    public readonly string $identifierEyebrow;
    public readonly string $identifierTitle;
    public readonly string $identifierTeaser;
    public readonly string $identifierShowCTAs;
    public readonly string $identifierShowBannerImages;
    public readonly string $identifierShowBannerCallout;


    //nodes
    public TextInputNode $nodeTitle;
    public TextInputNode $nodeEyebrow;
    public WysiwygNode $nodeTeaser;
    public CheckboxNode $nodeShowCTAs;
    public CheckboxNode $nodeShowBannerImages;
    public CheckboxNode $nodeShowBannerCallout;


    public function constructComponentGroupNode(): GroupNode
    {
        $heroGroupNode = new GroupNode($this->groupIdentifier);
        $heroGroupNode->addChild($this->nodeTitle);
        $heroGroupNode->addChild($this->nodeEyebrow);
        $heroGroupNode->addChild($this->nodeTeaser);
        $heroGroupNode->addChild($this->nodeShowCTAs);
        $heroGroupNode->addChild($this->nodeShowBannerImages);
        $heroGroupNode->addChild($this->nodeShowBannerCallout);
        foreach ($this->bannerImageObjArray as $bannerImageObj) {
            if ($bannerImageObj instanceof BannerImage) {
                $heroGroupNode->addChild($bannerImageObj->constructComponentGroupNode());
            }
        }

        foreach ($this->ctaObjArray as $ctaObj) {
            if ($ctaObj instanceof CTA) {
                $heroGroupNode->addChild($ctaObj->constructComponentGroupNode());
            }
        }
        $heroGroupNode->addChild($this->bannerCallout->constructComponentGroupNode());

        return $heroGroupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeEyebrow = new TextInputNode($this->identifierEyebrow, $this->eyebrow);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeTeaser = new WysiwygNode($this->identifierTeaser, $this->teaser);
        $this->nodeShowCTAs = new CheckboxNode($this->identifierShowCTAs, [$this->showCTAs]);
        $this->nodeShowBannerImages = new CheckboxNode($this->identifierShowBannerImages, [$this->showBannerImages]);
        $this->nodeShowBannerCallout = new CheckboxNode($this->identifierShowBannerCallout, [$this->showBannerCallout]);
    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'hero-statement';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierEyebrow = 'eyebrow';
        $this->identifierTitle = 'title';
        $this->identifierTeaser = 'teaser';
        $this->identifierShowCTAs = 'show-ctas';
        $this->identifierShowBannerImages = 'show-banner-images';
        $this->identifierShowBannerCallout = 'show-banner-callout';
    }
}
