<?php


namespace Alevel\Project\Plugin\Model;


use Alevel\Project\Api\Data\StatusInterface;

class StatusPlugin
{
    public function beforeSetLabel(StatusInterface $status, $label)
    {
        return [
            sprintf("{%s}", $label)
        ];
    }

    public function afterGetStatusCode(StatusInterface $status, $result)
    {
        return sprintf("|%s|", $result);
    }
}