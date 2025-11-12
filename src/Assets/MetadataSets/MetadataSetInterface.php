<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\MetadataSets;

interface MetadataSetInterface{

    public function setDisplayName(string $input):void;
    public function setTitle(string $input):void;
    public function setSummary(string $input):void;
    public function setTeaser(string $input):void;
    public function setKeywords(string $input):void;
    public function setDescription(string $input):void;
    public function setAuthor(string $input):void;
    public function setStartDate(string $input):void;
    public function setEndDate(string $input):void;
    public function setExpiration(string $input):void;
    public function setReviewDate(string $input):void;

}
