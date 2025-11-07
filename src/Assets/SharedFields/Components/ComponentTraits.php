<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents\Assets\SharedFields\Components;

trait ComponentTraits{

    public readonly string $groupIdentifier;

    public function getGroupIdentifier(): string
    {
        return $this->groupIdentifier;
    }
}