<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Http\Requests\UserDetailsRequest;

class UserController extends BaseController
{
    // Display User
    public function index(){
        $getUser = $this->user::all();
        return response()->json(['data' => $getUser]);
    }

    //Display specific user
    public function show($id){
        $findUser = $this->user::find($id);
        return response()->json(['User' => $findUser]);
    }
    
    //Update user only
    public function update(User $id, Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try{
            $id->update($validatedData);
            return response()->json(['data' => 'Updated Successfully','status' => 1]);
        } catch (\Throwable $e){
            return back()->with('error',$e->getMessage());
        }
    }

    //create user details only
    public function storeDetails(UserDetailsRequest $request){
        try{
            $getUserDetails =  $this->biography->where('user_id', auth()->user()->id)->first();

            if(!is_null($getUserDetails)){
                return response()->json(['data' => 'User Details Already Exist','status' => 0]);
            }

            DB::beginTransaction();
            $userDetails = $this->biography->create($request->validated());
            $this->biography->where('id', $userDetails->id)->update(['user_id'=> auth()->user()->id]);
            DB::commit();

            return response()->json(['data' => 'User Details Created Successfully','status' => 1]);
        } catch(\Throwable $e){
            dd($e->getMessage());
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    //update user details only
    public function updateDetails(Biography $id, UserDetailsRequest $request){
        try{
            $id->update($request->validated());
            return response()->json(['data' => 'User Details Updated Successfully','status' => 1]);
        } catch (\Throwable $e){
            return back()->with('error',$e->getMessage());
        }
    }

    //delete user details only
    public function destroyDetails($id){
        try{
            $this->biography->find($id)->delete();
            return true;
        } catch(Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }

}
