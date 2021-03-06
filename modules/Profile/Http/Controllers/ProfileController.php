<?php namespace KekecMed\Profile\Http\Controllers;

use Illuminate\Http\Request;
use KekecMed\Core\Abstracts\Controllers\AbstractController;
use KekecMed\Core\Abstracts\Controllers\Traits\Headful;

class ProfileController extends AbstractController
    implements Headful
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->query('pass') !== null) {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ]);

            \Auth::user()->update(['password' => bcrypt($request['password'])]);
        } else {
            $data = $request->toArray();

            \Auth::user()->update($data);
        }

        return redirect(route('profile.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get PageHeader
     *
     * @return string
     */
    public function getPageHeader()
    {
        return 'Profile';
    }

    /**
     * Get SubPageHeader
     *
     * @return string
     */
    public function getPageSubHeader()
    {
        return null;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

}