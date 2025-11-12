<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\ContentTypes;



use Edu\IU\Framework\GenericUpdater\Asset\Foldered\Page;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Logger;
use Edu\IU\Wcms\WebService\WCMSClient;

class PageDetails extends ContentTypeAbstract implements ContentPageInterface {
    use ContentTypeTraits;
    use ContentPageTraits;


    //identifiers
    public readonly string $identifierHero;
    public readonly string $identifierPageSettings;
    public readonly string $identifierPageContent;

    public function __construct(
        WCMSClient $wcms,
        Logger     $logger,
        string $pagePath,
        ?GroupNode $pageContentGroupNode = null,
        ?GroupNode $heroGroupNode = null,
        ?GroupNode $pageSettingsGroupNode = null,
        array $metadataArray = []
    ){

        parent::__construct($wcms, $logger, $pagePath);
        $this->setChildrenNodeIdentifiers();
        $this->setContentTypePath();
        $this->metadataArray = $metadataArray;
        $this->pageSettingsGroupNode = $pageSettingsGroupNode ?? new GroupNode($this->identifierPageSettings);
        $this->pageHeroGroupNode = $heroGroupNode ?? new GroupNode($this->identifierHero);
        $this->pageContentGroupNode = $pageContentGroupNode ?? new GroupNode($this->identifierPageContent);


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
                    ],
                ],
            ],
            'linkRewriting' => $this->linkRewriting,
        ];

        //to recursively convert $data to stdClass obj
        return json_decode(json_encode($data));
    }

    public function setChildrenNodeIdentifiers(): void
    {
        $this->identifierHero = 'hero';
        $this->identifierPageSettings = 'page-settings';
        $this->identifierPageContent = 'page-content';
    }

    public function setContentTypePath(): void
    {
        $this->contentTypePath = $this->commonSiteName . ':' . 'Page - Details';
    }





}