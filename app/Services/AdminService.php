<?php
namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

class AdminService {

    public function getAdmins(){
        return Admin::all();
    }

    public function getAdminById($id){
        return Admin::findOrFail($id);
    }

    public function createAdmin($data){
        return Admin::create($data);
    }

    public function updateAdmin($id,$data){
        $admin = $this->getAdminById($id);
        $admin->update($data);
        return $admin;
    }

    public function deleteAdmin($id){
        $admin = $this->getAdminById($id);
        if($admin->image != null){
            Storage::disk('avatars')->delete($admin->image);
        }
        $admin->delete();
    }
}