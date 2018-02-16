<?php 

namespace App\Repositories;

use App\UsersProfile;
use App\User;

class Haggler 
{
    public function featured ()
    {
        return User::join('users_profiles','users_profiles.user_id','=','users.id')
        
        ->join('users_remarks','users_remarks.user_id','=','users.id')
        
        ->where(['users_remarks.account_status' => 'Approve', 'users_remarks.account_type' => 'Featured'])
        
        ->get(['users.id','users.name','users_profiles.phone_number','users_profiles.email_address','users_profiles.city']);   
    }

    public function search ($input)
    {
        return User::join('users_profiles','users_profiles.user_id','=','users.id')
        
        ->join('users_remarks','users_remarks.user_id','=','users.id')
                
        ->where('users.name','Like',$input)

        ->get(['users.id','users.name','users_profiles.phone_number','users_profiles.email_address','users_profiles.city']);
    }
}