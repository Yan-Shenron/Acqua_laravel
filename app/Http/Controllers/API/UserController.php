<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Boitier;

class UserController extends Controller
{

    public function showUserList() //rename for customer ? as well in react 
    {
        return User::paginate(10);
    }

    public function getAuthUser()
    {
        return Auth::user();
    }

    public function showUser($id)
    {
        $user = User::find($id);
    
        if($user->state == '1'){
            $user->state = 'actif';
        }
        else{
            $user->state = 'inactif';
        }
    
        $parent = User::find($user->user_id);
    
        return [
            'user' => $user,
            'parent' => $parent
        ];
    }
    
    
    public function updateUserInfo(Request $request, $id){
        $user = Auth::user();
        $auth_id = $user->id;
        $role_id = $user->role_id;
        switch ($role_id) {
            case 1: // Admin
                $user = User::find($id);
                $user->update($request->all());
                return response()->json([
                    'message' => 'user updated successfully.'
                ],200);
                break;
            case 2: // Concessionaire
                if ($id == $auth_id) {
                    $user = User::find($id);
                    $user->update($request->all());
                return response()->json([
                    'message' => 'Your user updated successfully.'
                ],200);
                } else if (User::where('user_id', $auth_id)
                            ->where('role_id', 3)
                            ->where('id', $id)
                            ->exists() || User::where('user_id', $auth_id)
                            ->where('role_id', 4)
                            ->where('id', $id)
                            ->exists() || User::where('user_id', $auth_id)
                            ->where('role_id', 5)
                            ->where('id', $id)
                            ->exists()) {
                    $user = User::find($id);
                    $user->update($request->all());
                    return response()->json([
                        'message' => 'user updated successfully.'
                    ],200);
                }
                else {
                    return response()->json([
                        'error' => 'You are not authorized to update this user.'
                    ], 401);
                }
                break;
            case 3: // Revendeur
                if ($id == $auth_id) {
                    $user = User::find($id);
                    $user->update($request->all());
                    return response()->json([
                        'message' => 'Your user updated successfully.'
                    ],200);
                }
                else if (User::where('user_id', $auth_id)
                            ->where('role_id', 5)
                            ->where('id', $id)
                            ->exists() || User::where('user_id', $auth_id)
                            ->where('role_id', 4)
                            ->where('id', $id)
                            ->exists()) {
                    $user = User::find($id);
                    $user->update($request->all());
                    return response()->json([
                        'message' => 'user updated successfully.'
                    ],200);
                }
                else {
                    return response()->json([
                        'error' => 'You are not authorized to update this user.'
                    ], 401);
                }
                break;
            case 4: // Technicien
                if ($id == $auth_id) {
                    $user = User::find($id);
                    $user->update($request->all());
                    return response()->json([
                        'message' => 'Your user updated successfully.'
                    ],200);
                }
                else {
                    return response()->json([
                        'error' => 'You are not authorized to update this user.'
                    ], 401);
                }
                break;
            case 5: // Customer
                if ($id == $auth_id) {
                    $user = User::find($id);
                    $user->update($request->all());
                    return response()->json([
                        'message' => 'Your user updated successfully.'
                    ],200);
                }
                else {
                    return response()->json([
                        'error' => 'You are not authorized to update this user.'
                    ], 401);
                }
        }
    }


    //COUNTTOTAL
    public function countTotalCustomer()
    {
        $user = Auth::user();
        $id = $user->id;
        $role_id = $user->role_id;
        
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 5);
                    break;
                case 2: // Concessionaire
                    $distributeur_ids = User::where('user_id', $id)
                                        ->where('role_id', 2)
                                        ->pluck('id')->toArray();
                    $query->whereIn('user_id', $distributeur_ids)
                            ->where('role_id', 5);
                    break;
                case 3: // Revendeur
                    $query->where('user_id', $id)
                        ->where('role_id', 5);
                    break;
                case 4: // Technicien
                    $technicien_id = User::where('id', $id)->first()->user_id;
                    $query->where('user_id', $technicien_id)
                        ->where('role_id', 5);
                    break;
                case 5: // Customer
                    return $query;
            }
        };
        
        $total = User::where($conditions)->count();
    
        $inactive = User::where($conditions)
                        ->where('state', 0)
                        ->count();
    
        $active = User::where($conditions)
                        ->where('state', 1)
                        ->count();
        
        return [
            'total' => $total,
            'inactive' => $inactive,
            'active' => $active,
        ];
    }
    

    public function countTotalTech()
    {
        $user = Auth::user();
        $id = $user->id;
        $role_id = $user->role_id;
        
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 4);
                    break;
                case 2: // Concessionaire
                    $distributeur_ids = User::where('user_id', $id)
                                        ->where('role_id', 3)
                                        ->pluck('id')->toArray();
                    $query->whereIn('user_id', $distributeur_ids)
                            ->where('role_id', 4);
                    break;
                case 3: // Revendeur
                    $query->where('user_id', $id)
                        ->where('role_id', 4);
                    break;
                case 4: // Technicien
                    return [
                        'total' => 0,
                        'inactive' => 0,
                        'active' => 0,
                    ];
                case 5: // Customer
                    return [
                        'total' => 0,
                        'inactive' => 0,
                        'active' => 0,
                    ];
                }
            };
            
            $total = User::where($conditions)->count();
        
            $inactive = User::where($conditions)
                            ->where('state', 0)
                            ->count();
        
            $active = User::where($conditions)
                            ->where('state', 1)
                            ->count();
            
            return [
                'total' => $total,
                'inactive' => $inactive,
                'active' => $active,
            ];
        }
        
        
    public function countTotalReseller()
    {
        $user = Auth::user();
        $id = $user->id;
        $role_id = $user->role_id;
        
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 3);
                    break;
                case 2: // Concessionaire
                    $query->where('user_id', $id)
                        ->where('role_id', 3);
                    break;
                case 3: // Revendeur
                    return 0;
                case 4: // Technicien
                    return 0;
                case 5: // Customer
                    return 0;
                }
            };
            
            $total = User::where($conditions)->count();
        
            $inactive = User::where($conditions)
                            ->where('state', 0)
                            ->count();
        
            $active = User::where($conditions)
                            ->where('state', 1)
                            ->count();
            
            return [
                'total' => $total,
                'inactive' => $inactive,
                'active' => $active,
            ];
        }
        
    public function countTotalConcess()
    {
        $user = Auth::user();
        $id = $user->id;
        $role_id = $user->role_id;
        
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 2);
                    break;
                case 2: // Concessionaire
                    return 0;
                case 3: // Revendeur
                    return 0;
                case 4: // Technicien
                    return 0;
                case 5: // Customer
                    return 0;
                }
            };
            
            $total = User::where($conditions)->count();
        
            $inactive = User::where($conditions)
                            ->where('state', 0)
                            ->count();
        
            $active = User::where($conditions)
                            ->where('state', 1)
                            ->count();
            
            return [
                'total' => $total,
                'inactive' => $inactive,
                'active' => $active,
            ];
        }
        
    public function showCustomerList()
    {
        $auth_user = Auth::user();
        $id = $auth_user->id;
        $role_id = $auth_user->role_id;
        
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 5);
                    break;
                case 2: // Concessionaire
                    $distributeur_ids = User::where('user_id', $id)
                                        ->where('role_id', 2)
                                        ->pluck('id')->toArray();
                    $query->whereIn('user_id', $distributeur_ids)
                            ->where('role_id', 5);
                    break;
                case 3: // Revendeur
                    $query->where('user_id', $id)
                        ->where('role_id', 5);
                    break;
                case 4: // Technicien
                    $revendeur_id = User::where('id', $id)->first()->user_id;
                    $query->where('user_id', $revendeur_id)
                        ->where('role_id', 5);
                    break;
                case 5: // Customer
                    return $query;
            }
        };

        $data = [];

        $request = User::where($conditions)->get();
    
        foreach($request as $value){
            $id = $value->id;
            $company = $value->company;
            $name = $value->name;
            $firstname = $value->firstname;
            $country = $value->country;
            $state = $value->state;
            $parentId = $value->user_id;
            
            $parentName = null;
            $parentFirstname = null;
            
            if ($parentId) {
                $parent = User::find($parentId);
                $parentName = $parent->name;
                $parentFirstname = $parent->firstname;
            }
    
            array_push($data, [
                'id' => $id,
                'company' => $company,
                'name' => $name,
                'firstname' => $firstname,
                'parentId' => $parentId,
                'parentName' => $parentName,
                'parentFirstname' => $parentFirstname,
                'country' => $country,
                'state' => $state,
            ]);
        }
    
        return $data;
    }

    public function showResellerList()
    {
        $auth_user = Auth::user();
        $id = $auth_user->id;
        $role_id = $auth_user->role_id;
        
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 3);
                    break;
                case 2: // Concessionaire
                    $query->where('user_id', $id)
                        ->where('role_id', 3);
                    break;
                case 3: // Revendeur
                    return 0;
                case 4: // Technicien
                    return 0;
                case 5: // Customer
                    return 0;
                }
            };

        $data = [];

        $request = User::where($conditions)->get();
        
        foreach($request as $value){
            $id = $value->id;
            $company = $value->company;
            $name = $value->name;
            $firstname = $value->firstname;
            $country = $value->country;
            $state = $value->state;
            $concess_id = $value->id;
            $count = User::where('user_id', $concess_id)->count();
            
            array_push($data, [
                'id' => $id,
                'company' => $company,
                'name' => $name,
                'firstname' => $firstname,
                'country' => $country,
                'state' => $state,
                'count' => $count,
            ]);
        }
        
        return $data;
    }
    

    // CONCESSIONAIRE
    public function showConcessList()
    {
        $auth_user = Auth::user();
        $id = $auth_user->id;
        $role_id = $auth_user->role_id;
        
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 2);
                    break;
                case 2: // Concessionaire
                    return 0;
                case 3: // Revendeur
                    return 0;
                case 4: // Technicien
                    return 0;
                case 5: // Customer
                    return 0;
                }
            };

        $data = [];

        $request = User::where($conditions)->get();

        $data = [];
        
        foreach($request as $value){
            $id = $value->id;
            $company = $value->company;
            $name = $value->name;
            $firstname = $value->firstname;
            $country = $value->country;
            $state = $value->state;
            $concess_id = $value->id;
            $count = User::where('user_id', $concess_id)->count();
            
            array_push($data, [
                'id' => $id,
                'company' => $company,
                'name' => $name,
                'firstname' => $firstname,
                'country' => $country,
                'state' => $state,
                'count' => $count,
            ]);
        }

        return $data;
    }

    public function showTechList()
    {
        $auth_user = Auth::user();
        $id = $auth_user->id;
        $role_id = $auth_user->role_id;
        
        $conditions = function($query) use ($role_id, $id) {
            switch ($role_id) {
                case 1: // Admin
                    $query->where('role_id', 4);
                    break;
                case 2: // Concessionaire
                    $distributeur_ids = User::where('user_id', $id)
                                        ->where('role_id', 3)
                                        ->pluck('id')->toArray();
                    $query->whereIn('user_id', $distributeur_ids)
                            ->where('role_id', 4);
                    break;
                case 3: // Revendeur
                    $revendeur_ids = User::where('user_id', $id)
                                        ->where('role_id', 4)
                                        ->pluck('id')->toArray();
                case 4: // Technicien
                    return 0;
                case 5: // Customer
                    return 0;
                }
            };

        $data = [];

        $request = User::where($conditions)->get();

        $data = [];
        
        foreach($request as $value){
            $id = $value->id;
            $phone1 = $value->phone1;
            $name = $value->name;
            $firstname = $value->firstname;
            $country = $value->country;
            $state = $value->state;
            $concess_id = $value->id;
            $count = User::where('user_id', $concess_id)->count();
            
            array_push($data, [
                'id' => $id,
                'phone1' => $phone1,
                'name' => $name,
                'firstname' => $firstname,
                'country' => $country,
                'state' => $state,
                'count' => $count,
            ]);
        }

        return $data;
    }

    public function countResBelongToCons($id){
        $count = User::where('user_id', $id)->count();
        return $count;
    }
    
    public function showChildListBelongToParent($id){

        $user = User::where('user_id', $id)->get();

        $data = [];
        
        foreach($user as $value){
            $id = $value->id;
            $company = $value->company;
            $name = $value->name;
            $firstname = $value->firstname;
            $country = $value->country;
            $state = $value->state;
            // $concess_id = $value->id;
            // $count = User::where('user_id', $concess_id)->count();
            
            array_push($data, [
                'id' => $id,
                'company' => $company,
                'name' => $name,
                'firstname' => $firstname,
                'country' => $country,
                'state' => $state,
                // 'count' => $count,
            ]);
        }

        return $data;
    }
    

    public function countTotalActiveTech()
    {
        $activCount = DB::table('users')
        ->where('role_id', 4)
        ->where('state', 1)
        ->count();
        
        return $activCount;
    }
    
    public function countTotalInactiveTech()
    {
        $inactivCount = DB::table('users')
        ->where('role_id', 4)
        ->where('state', 0)
        ->count();
        
        return $inactivCount;
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $user = Auth::user();

        if ($user->password_changed) {
            return response()->json([
                'error' => 'Password has already been changed.'
            ], 400);
        }

        // Update the user's password
        $encryption = bcrypt($request->password);
        $user->password = $encryption;
        $user->password_changed = true;
        $user->save();

        return response()->json([
            'message' => $request->password,
        ]);
    }
    
    public function deleteUser($id)
    {
        $game = User::where('id', $id)->get();

        $game->each->delete();

        return 'succesfully deleted';
    }

    public function showConcessListForAssign()
    {
        return User::where('role_id', 2)->get();
    }

    public function showResellerListForAssign()
    {
        return User::where('role_id', 3)->get();
    }

    public function updateParentName(Request $request, $id){
        $newUser_id = $request['user_id'];
        $user = User::find($id);
        $user->user_id = $newUser_id;
        $user->save();

        return 'success';
    }

    public function updateEmail(Request $request){
        $auth_user = Auth::user();
        $id = $auth_user->id;
        if (User::where('email', $request['email'])->exists()) {
            return response()->json([
                'error' => 'Email already exists.'
            ], 400);
        }
        else {
            $user = User::find($id);
            $user->email = $request['email'];
            $user->save();
            return response()->json([
                'message' => 'Email updated successfully.'
            ]);
        }
}
}
