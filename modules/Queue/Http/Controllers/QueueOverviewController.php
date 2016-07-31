<?php namespace KekecMed\Queue\Http\Controllers;

use KekecMed\Core\Abstracts\Controllers\AbstractController;

/**
 * Class QueueOverviewController
 *
 * @author  Selcuk Kekec <senycorp@googlemail.com>
 * @package KekecMed\Queue\Http\Controllers
 */
class QueueOverviewController extends AbstractController
{

    /**
     * Index
     *
     * @return mixed
     */
    public function index()
    {
        return view('queue::overview.index');
    }
}