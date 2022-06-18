<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Biography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class UserController extends BaseController
{
    //
    protected $user;
    protected $biography;

    public function __construct(User $user, Biography $biography){
        $this->user = $user;
        $this->biography = $biography;
    }

    // Display User
    public function index(){
        $getUser = $this->user::all();
         return response()->json(['data' => $getUser]);
    }

    //Display specific user
    public function show($id){
        $findUser = $this->user::find($id);
        dd($this->user::find($id)->biography);
        
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
    public function storeDetails(Request $request){
        $request->validate([
            'gender' => 'required|string',
            'birth_date' => 'required|date_format:d-m-Y',
            'role' => 'required|string',
        ]);

        try{
            $getUserDetails =  $this->biography->where('user_id', auth()->user()->id)->first();

            if(!is_null($getUserDetails)){
                return response()->json(['data' => 'User Details Already Exist','status' => 0]);
            }

            DB::beginTransaction();
            $userDetails = $this->biography->create([
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'role' => $request->role,
                'user_id' => auth()->user()->id
            ]);
            DB::commit();

            return response()->json(['data' => 'User Details Created Successfully','status' => 1]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    //update user details only
    public function updateDetails(Biography $id, Request $request){
       $validatedData = $request->validate([
            'gender' => 'required|string',
            'birth_date' => 'required|date_format:d-m-Y',
            'role' => 'required|string',
        ]);
        
        try{
            $id->update($validatedData);
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
