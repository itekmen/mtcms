<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use Bllim\Datatables\Datatables;
use Illuminate\Support\Facades\Response;

class test extends Controller {
	/**
	 * Display a dashboard
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('mtcms.dashboard.index');
	}
}
