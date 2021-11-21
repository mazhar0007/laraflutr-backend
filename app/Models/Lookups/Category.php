<?php

namespace App\Models\Lookups;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\PseudoTypes\False_;

class Category extends Model
{
    use HasFactory;

    public $timestamps = False;

    protected $fillable = ['name'];
}
