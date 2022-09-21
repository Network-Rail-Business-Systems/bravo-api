<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class AttachmentDetail
{
    public string $fileName;
    public string|null $fileDescription;

    public function toArray(): array
    {
        return [
            'fileName' => $this->fileName,
            'fileDescription' => $this->fileDescription ?? null,
        ];
    }
}
