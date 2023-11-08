<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\StoreAdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
        //$this->authorizeResource(Admin::class, 'admin');
    }
    public function index()
    {
        //
        $this->authorize('viewAny', Admin::class);
        $admins = $this->adminService->getAdmins();
        return view('dashboard.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('viewAny', Admin::class);
        return view('dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        //
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $this->adminService->createAdmin($data);
        flash()->addSuccess('Admin is created successfully');

        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $this->authorize('update', Admin::class);
        $admin = $this->adminService->getAdminById($id);
        
        return view('dashboard.admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $admin = $this->adminService->getAdminById($id);

        $data = $request->except('_token','_method');
        if($admin->status ==1){
            $admin->status =0;
        }else{
            $admin->status=1;
        }
        $this->adminService->updateAdmin($id,$data);
        
        flash()->addSuccess('Admin is updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $this->authorize('delete', Admin::class);

        $admin = $this->adminService->getAdminById($id);

        if($admin->image != null){
            Storage::disk('avatars')->delete($admin->image);
        }
        $this->adminService->deleteAdmin($id);
        flash()->addSuccess('Admin is deleted successfully');
        return redirect()->back();
    }

    public function MarkAsRead_all(){
        $userUnReadNotifications = Auth::guard('admin')->user()->unreadNotifications;
        if($userUnReadNotifications){
            $userUnReadNotifications->markAsRead();
            return redirect()->back();
        }
    }
}
