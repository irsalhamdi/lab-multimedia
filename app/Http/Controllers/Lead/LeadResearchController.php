<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\Research;
use App\Models\ResearchTeacher;

class LeadResearchController extends Controller
{
    public function student()
    {
        $researchs = Research::where('status', 1)->filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.research.student', compact('researchs'));
    }

    public function teacher()
    {
        $researchs = ResearchTeacher::filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.research.teacher', compact('researchs'));
    }
}
