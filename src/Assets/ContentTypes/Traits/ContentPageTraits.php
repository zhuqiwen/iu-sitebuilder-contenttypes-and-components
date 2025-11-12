<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes\Traits;

use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\Wcms\WebService\WCMSClient;

trait ContentPageTraits{

    public GroupNode $pageContentGroupNode;
    public GroupNode $pageSettingsGroupNode;
    public GroupNode $pageHeroGroupNode;
    public GroupNode $profileGroupNode;
    public array $metadataArray;


    //identifiers
    public readonly string $identifierHero;
    public readonly string $identifierPageSettings;
    public readonly string $identifierPageContent;
    public readonly string $identifierProfile;

    public function __construct(
        WCMSClient $wcms,
        string $pagePath,
        ?GroupNode $pageContentGroupNode = null,
        ?GroupNode $heroGroupNode = null,
        ?GroupNode $pageSettingsGroupNode = null,
        ?GroupNode $profileGroupNode = null,
        array $metadataArray = []
    ){

        parent::__construct($wcms, $pagePath);
        $this->setChildrenNodeIdentifiers();
        $this->setContentTypePath();
        $this->metadataArray = $metadataArray;
        $this->pageSettingsGroupNode = $pageSettingsGroupNode ?? new GroupNode($this->identifierPageSettings);
        $this->pageHeroGroupNode = $heroGroupNode ?? new GroupNode($this->identifierHero);
        $this->pageContentGroupNode = $pageContentGroupNode ?? new GroupNode($this->identifierPageContent);
        $this->profileGroupNode = $profileGroupNode ?? new GroupNode($this->identifierHero);
    }

    public function setChildrenNodeIdentifiers(): void
    {
        $this->identifierHero = 'hero';
        $this->identifierPageSettings = 'page-settings';
        $this->identifierPageContent = 'page-content';
        $this->identifierProfile = 'information';
    }

    public function constructNewAsset(): \stdClass
    {
        $data = [
            'name' => $this->pageName,
            'parentFolderPath' => $this->pageParentFolderPath,
            'metadata' => $this->metadataArray,
            'contentTypePath' => $this->contentTypePath,
            'structuredData' => [
                'structuredDataNodes' => [
                    'structuredDataNode' => [
                        $this->pageSettingsGroupNode->getNodeArray(),
                        $this->pageHeroGroupNode->getNodeArray(),
                        $this->pageContentGroupNode->getNodeArray(),
                        $this->profileGroupNode->getNodeArray(),
                    ],
                ],
            ],
            'linkRewriting' => $this->linkRewriting,
        ];

        //to recursively convert $data to stdClass obj
        return json_decode(json_encode($data));
    }

}