<?php namespace KekecMed\Core\Http\Controllers\Core\Traits;

/**
 * Interface BreadCrumbful
 *
 * @package KekecMed\Core\Http\Controllers\Core\Traits
 */
interface Breadcrumbful
{

    /**
     * Breadcrumb: Root
     *
     * @return void
     */
    public function rootBreadcrumb();

    /**
     * Breadcrumb: Index
     *
     * @return void
     */
    public function indexBreadcrumb();

    /**
     * Breadcrumb: Edit
     *
     * @return void
     */
    public function editBreadcrumb($id);

    /**
     * Breadcrumb: Create
     *
     * @return void
     */
    public function createBreadcrumb();

    /**
     * Breadcrumb: Show
     *
     * @return void
     */
    public function showBreadcrumb($id);
}