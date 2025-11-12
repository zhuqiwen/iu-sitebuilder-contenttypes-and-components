<?php

namespace Edu\IU\WCMS\SiteBuilder\ContentTypesAndComponents;

class Logger{

    public readonly string $newlyCreatedAssetsLogFilePath;

    public function __construct(string $newlyCreatedAssetsLogFilePath)
    {
        $this->newlyCreatedAssetsLogFilePath = $newlyCreatedAssetsLogFilePath;
    }

    public function log(string $message, string $type = 'LOG'):void
    {

    }

    public function logSKip(string $msg):void
    {
        $this->log($msg, 'SKIP');
    }

    public function recordNewlyCreatedAsset(string $path, string $type):void
    {
        $dateTime = new \DateTime();
        $line = $path . ',' . $type . ',' . $dateTime->format('Y-m-d H:i:s') . PHP_EOL;
        file_put_contents($this->newlyCreatedAssetsLogFilePath, $line, FILE_APPEND);
    }

    public function getNewlyCreatedAssetPathAndType(string $recordFilePath = ''):array
    {
        $result = [];
        if (empty($recordFilePath)) {
            $recordFilePath = $this->newlyCreatedAssetsLogFilePath;
        }
        if(($handle = fopen($recordFilePath, 'r')) !== false) {
            while (($line = fgetcsv($handle, null, ',', '"', '\\')) !== false) {
                //path => type
                $result[$line[0]] = $line[1];
            }

        }

        return $result;

    }

    public function emptyNewlyCreatedAssetRecords(string $recordFilePath = ''):void
    {
        if (empty($recordFilePath)) {
            $recordFilePath = $this->newlyCreatedAssetsLogFilePath;
        }

        file_put_contents($recordFilePath, '');
    }
}