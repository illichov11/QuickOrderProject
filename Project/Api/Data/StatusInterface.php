<?php

namespace Alevel\Project\Api\Data;


interface StatusInterface
{
    const STATUS_ID = 'status_id';
    const STATUS_CODE = 'status_code';

    const LABEL = 'label';
    const IS_DEFAULT = 'is_default';

    /**
     * @return int|null
     * @return mixed
     */
    public function getStatusId();

    /**
     * @return mixed
     */
    public function  setStatusId();


    /**
     * @param string $code
     * @return StatusInterface
     */
    public function setStatusCode(string $code);

    /**
     * @return string
     */
    public function getStatusCode();

    /**
     * @param  string $label
     * @return StatusInterface
     */
    public function setLabel(string $label);

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param  bool $default
     * @return StatusInterface
     */
    public function setIsDefault(bool $default);

    /**
     * @return bool
     */
    public function getIsDefault();
}