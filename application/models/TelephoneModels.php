<?php



use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;
class TelephoneModels extends Eloquent{

    use SoftDeletes;
    protected $table = 'telephones';
    protected $fillable = ['id', 'direactions', 'idUser', 'deleted_at'];
    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function usuarios() {
        return $this->belongsTo(UsersModels::class, 'idUser', 'id');
    }
}