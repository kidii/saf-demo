<?php

namespace App\Models;

use App\Models\StudentStudyGroupPivot;
use Illuminate\Database\Eloquent\Model;
use App\QueryBuilders\SearchQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudyGroup extends Model
{
    use HasFactory;

    const PAGINATED_ITEMS = 10;

    protected $guarded = [];

    protected $casts = [
        'beginning_at' => 'datetime',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)
                    ->using(StudentStudyGroupPivot::class);
    }

    public function newEloquentBuilder($query)
    {
        return new SearchQueryBuilder($query);
    }
}
