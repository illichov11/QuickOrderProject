<?php


namespace Alevel\Project\Api;

use Alevel\Project\Api\Data\QuickOrderInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

interface QuickOrderRepositoryInterface
{
    /**
     * @param int $id
     * @return QuickOrderInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): QuickOrderInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface;

    /**
     * @param int $id
     * @return QuickOrderRepositoryInterface
     */
    public function deleteById(int $id);

    /**
     * @param QuickOrderInterface $quickOrder
     * @return QuickOrderInterface
     */
    public function save(QuickOrderInterface $quickOrder);

    /**
     * @param QuickOrderInterface $quickOrder
     * @return QuickOrderRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(QuickOrderInterface $quickOrder);

}
