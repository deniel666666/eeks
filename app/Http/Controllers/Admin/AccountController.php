<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
	public function index (Request $request) {

		// $value = $request->session()->get('user');
		// return $value;

		
		$viewData['pageTitle'] = '帳號管理';
		$viewData['sysCollapse'] = "show";
		$viewData['accountActive'] = "active";

		return view("admin.account.account",$viewData);
	}
}
