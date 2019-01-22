<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('admin.index');
    }

    public function getResetMasterData()
    {
        return view('admin.reset.masterdata.index');
    }

    public function resetMasterData()
    {
        $artisan = base_path("artisan");
        $cmd = "php ". $artisan ." db:seed --class=MasterDataSeeder > /dev/null 2>/dev/null &";
        //$cmd = "sh ".base_path("resetMasterData.sh")." > /dev/null 2>/dev/null &";
        shell_exec($cmd);

        return response()->redirectToRoute("admin.reset.masterdata.index", ['wait' => 45]);
    }
}
