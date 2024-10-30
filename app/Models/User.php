<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Core\Traits\SpatieLogsActivity;
use App\Helpers\HelperTraits\FileHelper;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Client;
use Modules\Warehouse\Entities\UserBranch;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\File;
use Modules\Users\Events\UserDeletedEvent;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements HasMedia, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SpatieLogsActivity, FileHelper, HasRoles;
    use InteractsWithMedia;


    /**
	 * directory user images.
	 * @var string
	 */
    const DIRECTORY_IMAGE = 'users_avatar';

    // Users Types
    const STAFF  = 0;
    const ADMIN  = 1;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'responsible_mobile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
	 * Revert avatar url.
	 * @return string
	 */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }

    public function getAvatarImageAttribute()
    {
        return $this->getFirstMediaUrl('avatar') ? $this->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png');
    }

    /**
	 * Revert user role.
	 * @return string
	 */
    public function getUserRoleAttribute()
    {
        $user_roles =  config('cms.user_roles');


        $modules_file = json_decode(File::get(base_path('modules_statuses.json')), true);
        foreach($modules_file as $module) {
            if(is_array(config('module_'.strtolower($module).'.user_roles'))){
                $user_roles = array_merge($user_roles, config('module_'.strtolower($module).'.user_roles'));
            }
        }
        $user_roles = array_merge($user_roles, config('module_cargo.user_roles'));
        return $user_roles[$this->role];
    }




    /**
	 * Observer locale.
	 */
    protected static function booted()
    {
        // when deleted user
        static::deleted(function ($user) {
            // remove avatar when deleted user
            if ($user->avatar && $user->avatar != null) {
                $user->deleteFile($user->avatar, self::DIRECTORY_IMAGE);
            }
            event(new UserDeletedEvent($user));
        });
    }

    public function getUsersOnly($query)
    {
        return $query->whereIn('role', [0,1]);
    }

    public function getAdminsOnly($query)
    {
        return $query->where('role', 1);
    }

    public function getStaffOnly($query)
    {
        return $query->where('role', 0);
    }

    public function getOthersOnly($query)
    {
        return $query->whereNotIn('role', [0,1]);
    }

    /*======================> Relations <=========================*/
    public function clientInfo()
    {
        return $this->hasOne(Client::class,'user_id');
    }
    public function Branches()
    {
        return $this->belongsToMany(Branch::class,UserBranch::class,'user_id','branch_id');

    }

}
