<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Follow;
use Illuminate\Support\Facades\DB;
use App\Achievement;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','name_address','header_img','icon_img','comment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers()
   {
       return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
                   ->withTimestamps();
   }

   public function follows()
   {
       return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
                   ->withTimestamps();
   }

   public function follow($userId)
   {
       $this->follows()->attach($userId);
       return $this;
   }

   public function unfollow($userId)
   {
       $this->follows()->detach($userId);
       return $this;
   }

   public function isFollowing($userId)
   {
       return (boolean) $this->follows()->where('follows_id', $userId)->first(['id']);
   }

   public function getRanking(){
   $collection = collect(User::orderBy('total_point', 'DESC')->get());
   $data       = $collection->where('id', $this->id);
   $value      = $data->keys()->first() + 1;
   return $value;
   }

   public function getMonthlyRanking(){
   $dt = Carbon::now();
   $dt = $dt->month;

   $collection = collect(Achievement::select('user_id',DB::raw('SUM(point) as monthly_point'))
               ->whereMonth('created_at','=',$dt)
               ->groupBy('user_id')
               ->orderBy('monthly_point','desc')
               ->get());

   $data       = $collection->where('user_id', $this->id);
   $value      = $data->keys()->first() + 1;
   return $value;
   }

   public function getHistoryRanking($dt){

   $collection = collect(Achievement::select('user_id',DB::raw('SUM(point) as monthly_point'))
               ->whereMonth('created_at','=',$dt)
               ->groupBy('user_id')
               ->orderBy('monthly_point','desc')
               ->get());

   $data       = $collection->where('user_id', $this->id);
   $value      = $data->keys()->first() + 1;
   return $value;
   }


    public function post()
    {
        return $this->hasMany('App\Post');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

}
