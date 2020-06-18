<?php


namespace Alevel\Project\Api;

use ALevel\Project\Api\Data\StatusInterface;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;

interface StatusRepositoryInterface
{
    /**
     * @param int $id
     * @return StatusInterface
     */
    public function getById(int $id) : StatusInterface;

    /**
     * @param int $id
     * @return StatusRepositoryInterface
     */
    public function deleteById(int $id) : StatusRepositoryInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : SearchResultInterface;

    /**
     * @param StatusInterface $status
     * @return StatusInterface
     */
    public function save(StatusInterface $status) : StatusInterface;

    /**
     * @param StatusInterface $status
     * @return StatusRepositoryInterface
     */
    public function delete(StatusInterface $status) : StatusRepositoryInterface;

}