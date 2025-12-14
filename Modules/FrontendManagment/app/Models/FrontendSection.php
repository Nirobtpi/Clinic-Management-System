<?php

namespace Modules\FrontendManagment\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\FrontendManagment\Database\Factories\FrontendSectionFactory;

class FrontendSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): FrontendSectionFactory
    // {
    //     // return FrontendSectionFactory::new();
    // }
}
