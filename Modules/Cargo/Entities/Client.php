<?php

namespace Modules\Cargo\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Staff;
use Modules\Cargo\Events\AddClient;
use Modules\Warehouse\Entities\PricingHistory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Client extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'clients';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
        $this->addMediaCollection('attachments');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }

    /**
     * Observer locale.
     */
    protected static function booted()
    {
        // when deleted user
        static::deleted(function ($client) {
            $client->user->delete();
        });
        static::created(function ($client) {
            $client->update(['code'=>$client->id]);
            event(new AddClient($client));
        });
    }
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ClientFactory::new();
    }

    /* =================> Attributes <=====================*/

    public function getFullAddressAttribute()
    {
        return "{$this->address},{$this->city},{$this->state},{$this->state},".optional($this->country)->iso3;
    }

    public function branch(){
        return $this->hasOne('Modules\Cargo\Entities\Branch', 'id', 'branch_id');
    }
    public function packages(){
        return $this->hasMany('Modules\Cargo\Entities\ClientPackage', 'client_id' , 'id');
    }

    public function getClients($query)
    {
        if(auth()->user()->role == 1){
            return $query->where('is_archived', 0);
        }elseif(auth()->user()->role == 3){
            $branch = Branch::where('user_id',auth()->user()->id)->pluck('id')->first();
        }elseif(auth()->user()->can('manage-customers') && auth()->user()->role == 0){
            $branch = Staff::where('user_id',auth()->user()->id)->pluck('branch_id')->first();
        }
        return $query->where('is_archived', 0)->where('branch_id', $branch);
    }
    public function addressess(){
        return $this->hasMany('Modules\Cargo\Entities\ClientAddress', 'client_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function pricingHistory(){
        return $this->hasMany(PricingHistory::class, 'client_id', 'id');
    }

}
