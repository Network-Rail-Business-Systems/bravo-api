<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class Attachment
{
    /** @var AttachmentDetail[] */
    public $attachment;

    public function toArray(): array
    {
        $attachments = [];

        if ($this->attachment !== null) {
            foreach ($this->attachment as $attachment) {
                $attachments[] = $attachment->toArray();
            }
        }

        return [
            'attachment' => $attachments,
        ];
    }
}
