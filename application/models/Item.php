<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Item extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'items';
    protected $fillable = ['id', 'itemId', 'title', 'globalId', 'category_ebay_id', 'galleryURL', 'viewItemURL', 'paymentMethods_ebay_id', 'zipcodes_id', 'currentPrice', 'convertedCurrentPrice', 'sellingState', 'timeLeft', 'bestOfferStatus', 'buyItNowStatus', 'itemscol', 'startTime', 'endTime', 'listingType', 'gift', 'returnsStatus', 'conditions_id', 'isMultiVariationListingStatus', 'topRatedListingStatus', 'Profiles_Ebay_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function profilesEbay() {
        return $this->belongsTo(ProfilesEbay::class, 'Profiles_Ebay_id', 'id');
    }

    public function categoryEbay() {
        return $this->belongsTo(CategoryEbay::class, 'category_ebay_id', 'id');
    }

    public function paymentmethodsEbay() {
        return $this->belongsTo(PaymentmethodsEbay::class, 'paymentMethods_ebay_id', 'id');
    }

    public function zipcode() {
        return $this->belongsTo(Zipcode::class, 'zipcodes_id', 'ID');
    }

    public function conditionsEbay() {
        return $this->belongsTo(ConditionsEbay::class, 'conditions_id', 'id');
    }


}
