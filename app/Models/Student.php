<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\StudentSex;
use App\Observers\StudentObserver;
use App\Models\StudentStudyGroupPivot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\QueryBuilders\SearchQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use Notifiable;

    const PAGINATED_ITEMS = 10;

    protected $guarded = [];

    protected $casts = [
        'date_of_birth' => 'datetime',
        'sex' => StudentSex::class,
    ];

    public function studyGroups()
    {
        return $this->belongsToMany(StudyGroup::class)
                    ->using(StudentStudyGroupPivot::class);
    }

    public function avatarUrl()
    {
        return "https://ui-avatars.com/api/?name=" . $this->name;
    }

    public function birthData()
    {
        return $this->place_of_birth . ', ' . Carbon::parse($this->date_of_birth)->format('Y.m.d.');
    }

    public function newEloquentBuilder($query)
    {
        return new SearchQueryBuilder($query);
    }
}
