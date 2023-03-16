<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Biography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Requests\BiographyRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserDetailResource;
use App\Http\Requests\UserCompleteFormRequest;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user, Biography $biography){
        $this->user = $user;
        $this->biography = $biography;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $getUser = User::with('biography')->get();
        
        return Inertia::render("Admin/User/Index",["users" => $getUser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render("Admin/User/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCompleteFormRequest $request)
    {
        //
        try {
            $userInput = $request->validated();
            $userInput['password'] = bcrypt($userInput['password']);
            $createdUser = $this->user->create($userInput);
            $bioUser = $this->biography->create(['user_id' => $createdUser->id] + $userInput);
            $this->address->create(['user_id' => $createdUser->id] + $userInput);
            $createdUser->assignRole($bioUser->role);

            return redirect()->route("users.index")->with('createUserMessage', sessionMessage()['createUserMessage']);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
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
        //
        $findUser = $this->user->with('biography')->find($id);
        return response()->json(['user' => $findUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $findUser = $this->user->with(['biography', 'address'])->find($id);
        return Inertia::render("Admin/User/Edit",['user'=>$findUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BiographyRequest $request, $id)
    {
        //
        try {
            DB::transaction(function () use ($request, $id){
                $user = User::find($id);

                $user->syncRoles($request->validated()['role']);

                $user->update([
                    'name' => $request->validated()['name'],
                    'email' => $request->validated()['email'],
                ]);

                $user->biography()->update([
                        'home_number' => $request->validated()['home_number'],
                        'gender' => $request->validated()['gender'],
                        'birth_date' => $request->validated()['birth_date'],
                        'role' => $request->validated()['role'],
                        'mobile_number' => $request->validated()['mobile_number'],
                        'address_line_one' => $request->validated()['address_line_one'],
                        'address_line_two' => $request->validated()['address_line_two'],
                        'postcode' => $request->validated()['postcode'],
                        'city' => $request->validated()['city'],
                        'state' => $request->validated()['state'],
                        'country' => $request->validated()['country'],
                ]);
            });

            return redirect()->back();
            
        } catch (\Throwable $e) {
            dd($e);
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
        //
    }
}
