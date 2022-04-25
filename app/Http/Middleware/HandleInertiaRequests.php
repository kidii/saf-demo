<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Inertia\Middleware;
use App\Models\StudyGroup;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use App\Models\StudentStudyGroupPivot;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () {
                return (new Ziggy)->toArray();
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
            'stats'  => function () use ($request) {
                return [
                    'allStudentsCount' => Student::count(),
                    'allStudyGroupsCount' => StudyGroup::count(),
                    'allStudentsInStudyGroups' => StudentStudyGroupPivot::distinct()->count('student_id')
                ];
            },
        ]);
    }
}