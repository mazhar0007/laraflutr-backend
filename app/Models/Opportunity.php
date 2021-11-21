<?php

namespace App\Models;

use App\Models\OpportunityDetail;

use App\Models\User;
use App\Models\Lookups\Country;
use App\Models\Lookups\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    /**
     *  To transform TimeStamps into String
     *  using $casts array
     */
    protected $casts = [
        'deadline' => 'datetime'
    ];

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'country_id',
        'deadline',
        'organizer',
        'created_by',
    ];

    public function detail() {
       return $this->hasOne(OpportunityDetail::class);
    }


    /**
     * Get the category that owns the Opportunity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
