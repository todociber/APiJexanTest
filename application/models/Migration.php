<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Migration extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'migrations';
    protected $fillable = ['version'];
    protected $dates = ['deleted_at'];



}
