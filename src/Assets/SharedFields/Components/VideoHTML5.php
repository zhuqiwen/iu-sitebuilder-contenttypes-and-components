<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

use Edu\IU\RSB\StructuredDataNodes\Asset\FileNode;
use Edu\IU\RSB\StructuredDataNodes\Asset\SymlinkNode;
use Edu\IU\RSB\StructuredDataNodes\GroupNode;
use Edu\IU\RSB\StructuredDataNodes\Text\DropdownNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextInputNode;
use Edu\IU\RSB\StructuredDataNodes\Text\TextNode;
use Edu\IU\RSB\StructuredDataNodes\Text\WysiwygNode;

class VideoHTML5 implements ComponentInterface{

    use ComponentTraits;

    //content
    public string $videoType;
    public string $headingLevel;
    public string $thumbnailId;
    public string $thumbnailPath;
    public string $mp4Id;
    public string $mp4Path;
    public string $webmId;
    public string $webmPath;
    public string $mp4DescribedId;
    public string $mp4DescribedPath;
    public string $webmDescribedId;
    public string $webmDescribedPath;
    public string $vttId;
    public string $vttPath;
    public string $descriptionsFileId;
    public string $descriptionsFilePath;

    public string $title;
    public string $transcript;
    public string $caption;

    //identifiers;
    public readonly string $identifierVideoType;
    public readonly string $identifierHeadingLevel;
    public readonly string $identifierThumbnail;
    public readonly string $identifierMP4;
    public readonly string $identifierWebm;
    public readonly string $identifierMP4Described;
    public readonly string $identifierWebmDescribed;
    public readonly string $identifierVtt;
    public readonly string $identifierDescriptionsFile;
    public readonly string $identifierTitle;
    public readonly string $identifierTranscript;
    public readonly string $identifierCaption;

    //nodes
    public DropdownNode $nodeVideoType;
    public DropdownNode $nodeHeadingLevel;
    public FileNode $nodeThumbnail;
    public FileNode $nodeMP4;
    public FileNode $nodeWebm;
    public FileNode $nodeMP4Described;
    public FileNode $nodeWebmDescribed;
    public FileNode $nodeVtt;
    public FileNode $nodeDescriptionsFile;

    public TextInputNode $nodeTitle;
    public WysiwygNode $nodeTranscript;
    public WysiwygNode $nodeCaption;

    public function __construct(
        string $headingLevel = '2',
        string $thumbnailId = '',
        string $thumbnailPath = '',
        string $mp4Id = '',
        string $mp4Path = '',
        string $webmId = '',
        string $webmPath = '',
        string $mp4DescribedId = '',
        string $mp4DescribedPath = '',
        string $webmDescribedId = '',
        string $webmDescribedPath = '',
        string $vttId = '',
        string $vttPath = '',
        string $descriptionsFileId = '',
        string $descriptionsFilePath = '',
        string $title = '',
        string $transcript = '',
        string $caption = '',
    )
    {
        $this->videoType = 'html5';
        $this->headingLevel = $headingLevel;
        $this->thumbnailId = $thumbnailId;
        $this->thumbnailPath = $thumbnailPath;
        $this->mp4Id = $mp4Id;
        $this->mp4Path = $mp4Path;
        $this->webmId = $webmId;
        $this->webmPath = $webmPath;
        $this->mp4DescribedId = $mp4DescribedId;
        $this->mp4DescribedPath = $mp4DescribedPath;
        $this->webmDescribedId = $webmDescribedId;
        $this->webmDescribedPath = $webmDescribedPath;
        $this->vttId = $vttId;
        $this->vttPath = $vttPath;
        $this->descriptionsFileId = $descriptionsFileId;
        $this->descriptionsFilePath = $descriptionsFilePath;
        $this->title = $title;
        $this->transcript = $transcript;
        $this->caption = $caption;

        $this->finishConstructor();
    }


    public function constructComponentGroupNode(): GroupNode
    {
        $groupNode = new GroupNode($this->groupIdentifier);
        $groupNode->addChild($this->nodeVideoType);
        $groupNode->addChild($this->nodeHeadingLevel);
        $groupNode->addChild($this->nodeThumbnail);
        $groupNode->addChild($this->nodeMP4);
        $groupNode->addChild($this->nodeWebm);
        $groupNode->addChild($this->nodeMP4Described);
        $groupNode->addChild($this->nodeWebmDescribed);
        $groupNode->addChild($this->nodeVtt);
        $groupNode->addChild($this->nodeDescriptionsFile);
        $groupNode->addChild($this->nodeTitle);
        $groupNode->addChild($this->nodeTranscript);
        $groupNode->addChild($this->nodeCaption);

        return $groupNode;
    }

    public function constructChildrenNodes(): void
    {
        $this->nodeVideoType = new DropdownNode($this->identifierVideoType, $this->videoType);
        $this->nodeHeadingLevel = new DropdownNode($this->identifierHeadingLevel, $this->headingLevel);
        $this->nodeThumbnail = new FileNode($this->identifierThumbnail, $this->thumbnailId, $this->thumbnailPath);
        $this->nodeMP4 = new FileNode($this->identifierMP4, $this->mp4Id, $this->mp4Path);
        $this->nodeWebm = new FileNode($this->identifierWebm, $this->webmId, $this->webmPath);
        $this->nodeMP4Described = new FileNode($this->identifierMP4Described, $this->mp4DescribedId, $this->mp4DescribedPath);
        $this->nodeWebmDescribed = new FileNode($this->identifierWebmDescribed, $this->webmDescribedId, $this->webmDescribedPath);
        $this->nodeVtt = new FileNode($this->identifierVtt, $this->vttId, $this->vttPath);
        $this->nodeDescriptionsFile = new FileNode($this->identifierDescriptionsFile, $this->descriptionsFileId, $this->descriptionsFilePath);
        $this->nodeTitle = new TextInputNode($this->identifierTitle, $this->title);
        $this->nodeTranscript = new WysiwygNode($this->identifierTranscript, $this->transcript);
        $this->nodeCaption = new WysiwygNode($this->identifierCaption, $this->caption);

    }

    public function setGroupIdentifier(): void
    {
        $this->groupIdentifier = 'video';
    }

    public function setChildrenIdentifiers(): void
    {
        $this->identifierVideoType = 'video-type';
        $this->identifierHeadingLevel = 'heading-level';
        $this->identifierThumbnail = 'thumbnail';
        $this->identifierMP4 = 'mp4';
        $this->identifierWebm = 'webm';
        $this->identifierMP4Described = 'mp4-described';
        $this->identifierWebmDescribed = 'webm-described';
        $this->identifierVtt = 'vtt';
        $this->identifierDescriptionsFile = 'descriptions-file';
        $this->identifierTitle = 'title';
        $this->identifierTranscript = 'transcript';
        $this->identifierCaption = 'caption';
    }
}
