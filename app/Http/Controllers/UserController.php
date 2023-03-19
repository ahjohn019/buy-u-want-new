<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Biography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\BiographyRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserDetailResource;
// use App\Http\Requests\UserCompleteFormRequest;

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
    public function store(Request $request)
    {
        //
        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make('1111aaaa'),
                    'password_confirmation' => Hash::make('1111aaaa')
                ]);

                $user->assignRole($request->role);

                $user->biography()->create([
                    'gender' => $request->gender,
                    'birth_date' => $request->birth_date,
                    'role' => $request->role,
                    'home_number' => $request->home_number,
                    'mobile_number' => $request->mobile_number,
                    'address_line_one' => $request->address_line_one,
                    'address_line_two' => $request->address_line_two,
                    'postcode' => $request->postcode,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'user_id' => $user->id
                ]);
            });

            return redirect()->back();
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
                $payload = $request->validated();

                $user->syncRoles($payload['role']);

                $user->update([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                ]);

                $user->biography()->update([
                        'home_number' => $payload['home_number'],
                        'gender' => $payload['gender'],
                        'birth_date' => $payload['birth_date'],
                        'role' => $payload['role'],
                        'mobile_number' => $payload['mobile_number'],
                        'address_line_one' => $payload['address_line_one'],
                        'address_line_two' => $payload['address_line_two'],
                        'postcode' => $payload['postcode'],
                        'city' => $payload['city'],
                        'state' => $payload['state'],
                        'country' => $payload['country'],
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
