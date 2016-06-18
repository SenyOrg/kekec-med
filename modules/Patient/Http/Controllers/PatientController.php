<?php namespace KekecMed\Patient\Http\Controllers;

use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;
use KekecMed\Core\Http\Controllers\Core\Traits\Breadcrumbful;
use KekecMed\Core\Http\Controllers\Core\Traits\DataTable;
use KekecMed\Core\Http\Controllers\Core\Traits\ValidatableRest;
use KekecMed\Core\Http\Controllers\Core\View\AbstractViewController;
use KekecMed\Core\Http\Controllers\CoreConventionalResourceViewController;
use KekecMed\Core\Http\Controllers\CoreDataTableController;
use KekecMed\Core\Http\Controllers\CoreValidationController;
use KekecMed\Insurance\Entities\Insurance;
use KekecMed\Patient\Entities\Patient;

class PatientController extends AbstractViewController
    implements DataTable, ValidatableRest, Breadcrumbful
{

    /**
     * Get DataTable
     *
     * @return \KekecMed\Core\Http\Controllers\DataTable
     */
    public function getDataTable()
    {
        return app('KekecMed\Patient\DataTables\PatientTable');
    }

    /**
     * Get DataTable index template
     *
     * 'module::index'
     *
     * @return string
     */
    public function getDataTableTemplatePath()
    {
        return 'patient::index';
    }

    /**
     * Get model for create()
     *
     * @return Model
     */
    public function getModelForCreate()
    {
        $model = $this->getModel();
        $model->insurance = new Insurance();

        return $model;
    }

    /**
     * Get Validation rules
     *
     * @return array
     */
    public function getValidationRules()
    {
        // TODO: Implement validation rules
        return [];
    }

    /**
     * Should request validated while update procedure
     *
     * @return boolean
     */
    public function validateOnUpdate()
    {
        return true;
    }

    /**
     * Should request validated while store procedure
     *
     * @return boolean
     */
    public function validateOnStore()
    {
        return true;
    }

    /**
     * Breadcrumb: Root
     *
     * @return void
     */
    public function rootBreadcrumb()
    {
        $this->getViewComponent()->modifyBreadcrumb(function ($menu) {
            $menu->route(
                $this->getRouteName('index'),
                'Patients',
                [],
                0,
                []
            );
        });
    }

    /**
     * Breadcrumb: Index
     *
     * @return void
     */
    public function indexBreadcrumb()
    {
        $this->getViewComponent()->modifyBreadcrumb(function ($menu) {
            $menu->route(
                $this->getRouteName('index'),
                'All Patients',
                [],
                0,
                [
                    'icon' => 'fa fa-list'
                ]
            );
        });
    }

    /**
     * Breadcrumb: Edit
     *
     * @return void
     */
    public function editBreadcrumb($id)
    {
        $class = $this->getModelClass();
        $model = $class::find($id);
        $this->getViewComponent()->modifyBreadcrumb(function ($menu) use ($model) {
            $menu->route(
                $this->getRouteName('edit'),
                $model->getFullName(),
                [
                    'id' => $model->id
                ],
                0,
                [
                    'icon' => 'fa fa-user'
                ]
            );
        });
    }

    /**
     * Get model class
     *
     * @return Model
     */
    protected function getModelClass()
    {
        return Patient::class;
    }

    /**
     * Breadcrumb: Create
     *
     * @return void
     */
    public function createBreadcrumb()
    {
        $this->getViewComponent()->modifyBreadcrumb(function ($menu) {
            $menu->route(
                $this->getRouteName('create'),
                '[Firstname] [Lastname]',
                [],
                0,
                [
                    'icon' => 'fa fa-user'
                ]
            );
        });
    }

    /**
     * Breadcrumb: Show
     *
     * @return void
     */
    public function showBreadcrumb($id)
    {
        $class = $this->getModelClass();
        $model = $class::find($id);
        $this->getViewComponent()->modifyBreadcrumb(function ($menu) use ($model) {
            $menu->route(
                $this->getRouteName('show'),
                $model->getFullName(),
                [
                    'id' => $model->id
                ],
                0,
                [
                    'icon' => 'fa fa-user'
                ]
            );
        });
    }

    /**
     * Get model for create()
     *
     * @return Model
     */
    public function getCreateModel()
    {
        $model = parent::getCreateModel();
        $model->insurance = new Insurance();

        return $model;
    }

    /**
     * Get Module identifier
     *
     * @return string
     */
    protected function getIdentifier()
    {
        return 'patient';
    }
}