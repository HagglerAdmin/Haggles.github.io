<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'name', 'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // plant session
    public function userSession() {

        session([   
            'id' => auth::id(),
            'name' => auth::user()->name,
            'username' => auth::user()->username
        ]);
    }

    // take picture
    public function pictureFunction() {

        return $this->picture()->where('photo_type', 'display')->get(['user_photo']);
    }
    
    public function pictureFunctionFirst() {

        return $this->picture()->where('photo_type', 'display')->select('user_photo')->first();
    }

    //    user profile
    public function profile() {
        
        
        return $this->hasOne(UsersProfile::class);
    }

    //    user remarks
    public function remark() {

        return $this->hasOne(UsersRemarks::class);
    }

    // user online
    public function online() {

        return $this->hasOne(Online::class);
    }

    // user display picture
    public function picture() {
        
        return $this->hasMany(UsersPhoto::class);
    }

    // user products
    public function product() {
        
        return $this->hasMany(Product::class);
    }

    public function productcomment() {

        return $this->hasMany(ProductsComment::class);
    }

    public function messages()
    {
    
        return $this->hasMany(Message::class);
    }

    public function order() {

        return $this->hasMany( Order::class);
    }

    public function activity() {

        return $this->hasMany(Activity::class);
    }

    public function visitors() {

        return $this->hasMany(UsersVisitors::class);
    }

    public function notification(){

        return $this->hasMany(Notification::class, 'user_to');
    }

    public function billing() {

        return $this->hasOne( Billing::class, 'users_id');
    }

    public function convo () {

        return $this->hasMany( BargainsConversation::class, 'users_id' );
    }
}