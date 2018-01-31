<?php
namespace App\Admin\Controllers;

use \App\AdminUser;

class UserController extends Controller
{
    //管理员列表页
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    //管理员创建页面
    public function create()
    {
        return view('admin.user.add');
    }

    //创建操作
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'password' => 'required',
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name', 'password'));

        return redirect("/admin/users");
    }

    //用户角色页面
    public function role(\App\AdminUser $user)
    {
        //所有的角色
        $roles = \App\AdminRole::all();
        //我的角色
        $myRoles = $user->roles;

        return view('/admin/user/role', compact('roles', 'myRoles', 'user'));
    }

    //储存用户角色
    public function storeRole(\App\AdminUser $user)
    {
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);

        $roles = \App\AdminRole::findMany(request('roles'));
        //我的角色
        $myRoles = $user->roles;

        //有重复的部分
        //要增加的
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role) {
            $user->assignRole($role);
        }
        //要删除的
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role) {
            $user->deleteRoles($role);
        }

        return back();
    }
}