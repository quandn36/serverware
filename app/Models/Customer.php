<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Authenticatable
{
    protected $table = 'customers';

    use HasFactory, Notifiable;
    use softDeletes;
    ## usable data fields
    protected $fillable = [
        'id',
        'name',
        'email',
        'tel',
        'password',
        'company',
        'deleted_at'
    ];

    ##
    protected $hidden = [
        'password',
        'remember_token',
    ];

    ## format the date and time
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:m-d-Y',
        'updated_at' => 'datetime:m-d-Y',
    ];

    ## format the action
    protected $appends = ['action'];
    public function getActionAttribute() {
        $action = '<div style="display:flex;">'.
                  '<a href="'. route('customers.edit', ['id' => $this->id]) .'" class="btn btn btn-info waves-effect waves-light" style="margin-right:5%;"><i class="fas fa-edit"></i></a>'.
                  '<a  class="btn btn-warning waves-effect waves-light btn-reset-pw" data-title="'.$this->email.'" data-id="'.$this->id.'" style="margin-right:5%;"><i class="fas fa-undo"></i></a>'.
                  '<a href="javascript:void;" class="btn btn-secondary waves-effect waves-light btn-delete" data-id="'.$this->id.'" data-title="'.$this->name.'"><i class="fas fa-trash-alt"></i></a>'.
                  '</div>';
        return $action;
    }
}


