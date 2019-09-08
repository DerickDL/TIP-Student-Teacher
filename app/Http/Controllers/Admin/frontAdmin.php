<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\App\frontUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class frontAdmin extends frontUsers
{
    public function loginPage()
    {
        return view('pages.admin.login');
    }

    public function instructorsPage()
    {
        $aSession = $this->getSession();
        return view('pages.admin.admin_instructor')->with('aSession', $aSession);
    }
}
