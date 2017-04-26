<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilesEbay extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'profiles_ebay';
    protected $fillable = ['id', 'username', 'New_User_status', 'Status_Confirmed', 'RegistrationDate', 'RegistrationSite', 'SellerBusiness_Type', 'SellerItemsURL', 'FeedbackDetailsURL', 'PositiveFeedbackPercent', 'users_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function items() {
        return $this->hasMany(Item::class, 'Profiles_Ebay_id', 'id');
    }


}
