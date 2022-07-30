<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Http\Requests\StoreUserGroupRequest;
use App\Http\Requests\UpdateUserGroupRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', UserGroup::class);
        $userGroups = UserGroup::select('*')->paginate(5);
        $params = [
            'userGroups' => $userGroups,
        ]; 
        return view('backend.userGroups.index',$params); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.userGroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserGroupRequest $request)
    {
        $userGroup = new UserGroup();
        $userGroup->name = $request->name;
        try {
            $userGroup->save();
            return redirect()->route('userGroups.index')->with('success','Thêm'. ' ' . $request->name.' '.  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('userGroups.index')->with('error','Thêm'. ' ' . $request->name.' '.  'không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userGroup = UserGroup::find($id);
        $params = [
            'userGroup'=> $userGroup
        ];
        return view('backend.userGroups.show',$params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userGroup = UserGroup::find($id);
        // $this->authorize('update',  $userGroup);
        // $current_user = Auth::user();
        $userRoles = $userGroup->roles->pluck('id', 'name')->toArray();
        $roles = Role::all()->toArray();
        $group_names = [];
        foreach ($roles as $role) {
            $group_names[$role['group_name']][] = $role;
        }
        $params = [
            'userRoles' => $userRoles,
            'group_names' => $group_names,
            'userGroup' => $userGroup
        ];
        return view('backend.userGroups.edit',$params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserGroupRequest $request, $id)
    {
        $userGroup = UserGroup::find($id);
        $userGroup->name = $request->name;
        try {
            $userGroup->save();
            //detach xóa hết tất cả các record của bảng trung gian hiện tại
            $userGroup->roles()->detach();
            //attach cập nhập các record của bảng trung gian hiện tại
            $userGroup->roles()->attach($request->roles);
            return redirect()->route('userGroups.index')->with('success','Sửa'. ' ' . $request->name.' '.  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('userGroups.index')->with('error','Sửa'. ' ' . $request->name.' '.  'không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $userGroup = UserGroup::find($id);
        try {
            $userGroup->delete();
            return redirect()->route('userGroups.index')->with('success','Xóa danh mục thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('userGroups.index')->with('error','Xóa'. 'không thành công');
        }

        
        
    }
}
