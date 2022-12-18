<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Biography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\UserDetailsRequest;

class UserController extends BaseController
{
    /**
     * Display All User
     *
     * @return void
     */
    public function index(){
        $getUser = $this->user::displayAdminInfo()->get();

        return Inertia::render("Admin/User/Index",["users" => $getUser]);
    }

    /**
     * Display Specific User
     *
     * @param integer $id
     * @return void
     */
    public function show($id){
        $findUser = $this->user::select('id','email','name','created_at')->with('address','biography')->find($id);
        return response()->json(['user' => $findUser]);
    }
    
    /**
     * Update Specific User
     *
     * @param User $id
     * @param Request $request
     * @return void
     */
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

    /**
     * Store User Details
     *
     * @param UserDetailsRequest $request
     * @return void
     */
    public function storeDetails(UserDetailsRequest $request){
        try{
            $getUserDetails =  $this->biography->where('user_id', auth()->user()->id)->first();

            if(!is_null($getUserDetails)){
                return response()->json(['data' => 'User Details Already Exist','status' => 0]);
            }

            DB::beginTransaction();
            $userDetails = $this->biography->create($request->validated());
            $this->biography->where('id', $userDetails->id)->update(['user_id'=> auth()->user()->id]);

            $getUser = $this->user::find(auth()->user()->id);
            $getUser->pivotBiography()->sync($userDetails->id);
            
            DB::commit();

            return response()->json(['data' => 'User Details Created Successfully','status' => 1]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Store User Address
     *
     * @param Request $request
     * @return void
     */
    public function storeAddress(UserAddressRequest $request){
        //
        try {
            DB::beginTransaction();
            $userDetails = $this->address->create($request->validated());
            $this->address->where('id', $userDetails->id)->update(['user_id'=> auth()->user()->id]);

            $getUser = $this->user::find(auth()->user()->id);
            $getUser->pivotAddress()->sync($userDetails->id);
            
            DB::commit();

        } catch (\Throwable $e) {
            dd($e);
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update Specific User Details
     *
     * @param Biography $id
     * @param UserDetailsRequest $request
     * @return void
     */
    public function updateDetails(User $id, UserDetailsRequest $request){
        try{
            $id->biography->update($request->validated());
            return response()->json(['data' => 'User Details Updated Successfully','status' => 1]);
        } catch (\Throwable $e){
            return back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update Specific User Address
     *
     * @param Address $id
     * @param UserDetailsRequest $request
     * @return void
     */
    public function updateAddress(User $id, UserAddressRequest $addressRequest){
        try {
            $inputAddress = request()->input('address_id');
            $findAddress = $id->address->where('id',$inputAddress)->first();
            $findAddress->update($addressRequest->validated());
            return response()->json(['data' => 'User Address Updated Successfully','status' => 1]);
        } catch (\Throwable $e) {
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
