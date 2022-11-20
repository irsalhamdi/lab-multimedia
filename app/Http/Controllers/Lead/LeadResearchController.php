<?php

namespace App\Http\Controllers\Lead;

use App\Models\Research;
use App\Models\ResearchTeacher;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LeadResearchController extends Controller
{
    public function student()
    {
        $years = Research::select(DB::raw('LEFT(`created_at`, 4) AS year'))
                                    ->distinct()
                                    ->get();

        $researchs = Research::where('status', 1)->filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.research.student', compact('researchs', 'years'));
    }

    public function teacher()
    {   
        $years = ResearchTeacher::select(DB::raw('LEFT(`date`, 4) AS year'))
                            ->distinct()
                            ->get();

        $researchs = ResearchTeacher::filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.research.teacher', compact('researchs', 'years'));
    }
}
