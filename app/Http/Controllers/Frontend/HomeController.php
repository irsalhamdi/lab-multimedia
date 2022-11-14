<?php

namespace App\Http\Controllers\Frontend;

use Share;
use App\Models\News;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\Regency;
use App\Models\Release;
use App\Models\Trainer;
use App\Models\Village;
use App\Models\District;
use App\Models\Training;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Models\ReleaseComment;
use App\Models\ReleaseCategory;
use App\Models\LearningMaterial;
use App\Models\TrainingCategory;
use Illuminate\Support\Facades\DB;
use App\Models\CommunityDedication;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Dosen;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Schedule;
use App\Models\Tool;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::with('category')->latest()->limit(3)->get();

        $trainings = Training::with('category')->latest()->limit(3)->get();
        $latest = Training::with('category')->latest()->limit(1)->first();
        $dedications = CommunityDedication::with('dosen')->latest()->limit(2)->get();
        
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();
        
        $title = 'Lab Multimedia';

        return view('frontend.index', compact('title', 'news', 'trainings', 'latest', 'dedications', 'contact', 'regency', 'district', 'village'));
    }

    public function categories($id)
    {
        $category = NewsCategory::findOrFail($id);
        $news = News::where('news_categories_id', $category->id)->paginate(3);
        $recents = News::with('category')->latest()->limit(4)->get();
        $categories = NewsCategory::orderBy('name', 'ASC')->get();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Kategori Berita | ' .$category->name;
        
        return view('frontend.news.category', compact('title', 'news', 'recents', 'categories', 'contact', 'regency', 'district', 'village'));
    }

    public function news()
    {   
        $news = News::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        $recents = News::with('category')->latest()->limit(4)->get();
        $categories = NewsCategory::orderBy('name', 'ASC')->get();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Berita';

        return view('frontend.news.index', compact('title', 'news', 'recents', 'categories', 'contact', 'regency', 'district', 'village'));
    }

    public function new($id)
    {
        $new = News::findOrFail($id);

        $news = News::with('category')->latest()->get();
        $recents = News::with('category')->latest()->limit(4)->get();
        $categories = NewsCategory::orderBy('name', 'ASC')->get();
        $comments = Comment::with('admin', 'asistant', 'dosen', 'lead', 'user')->where('new_id', $id)->get();
        $count = Comment::where('new_id', $id)->get()->count();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = $new->title;

        $shares = Share::page('http://127.0.0.1:8000/berita/detail/'.$new->id, $title)
                    ->facebook()
                    ->twitter()
                    ->linkedin()
                    ->whatsapp()
                    ->getRawLinks();

        return view('frontend.news.detail', compact('title', 'new', 'news', 'recents', 'categories', 'comments', 'count', 'shares', 'contact', 'regency', 'district', 'village'));
    }

    public function categoriesTraining($id)
    {
        $category = TrainingCategory::findOrFail($id);
        $trainings = Training::where('training_categories_id', $category->id)->paginate(3);
        $recents = Training::with('category')->latest()->limit(4)->get();
        $categories = TrainingCategory::orderBy('name', 'ASC')->get();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Kategori Pelatihan | ' . $category->name;

        return view('frontend.training.category', compact('title', 'trainings', 'recents', 'categories', 'contact', 'regency', 'district', 'village'));
    }

    public function trainings()
    {
        $trainings = Training::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        $recents = Training::with('category')->latest()->limit(4)->get();
        $categories = TrainingCategory::orderBy('name', 'ASC')->get();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Pelatihan';

        return view('frontend.training.index', compact('title', 'trainings', 'recents', 'categories', 'contact', 'regency', 'district', 'village'));
    }

    public function training($id)
    {
        $training = Training::findOrFail($id);
        $trainer = Trainer::where('training_id', $training->id)->first();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = $training->name;

        $shares = Share::page('http://127.0.0.1:8000/pelatihan/detail/'.$training->id, $title)
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->getRawLinks();

        return view('frontend.training.detail', compact('title', 'training', 'trainer', 'shares', 'contact', 'regency', 'district', 'village'));
    }

    public function categoriesRelease($id)
    {
        $category = ReleaseCategory::findOrFail($id);
        $releases = Release::where('release_categories_id', $category->id)->paginate(3);
        $recents = Release::with('category')->latest()->limit(4)->get();
        $categories = ReleaseCategory::orderBy('name', 'ASC')->get();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Kategori Rilis | ' . $category->name;

        return view('frontend.release.category', compact('title', 'releases', 'recents', 'categories', 'contact', 'regency', 'district', 'village'));
    }

    public function releases()
    {
        $releases = Release::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        $recents = Release::with('category')->latest()->limit(4)->get();
        $categories = ReleaseCategory::orderBy('name', 'ASC')->get();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Rilis';

        return view('frontend.release.index', compact('title', 'releases', 'recents', 'categories', 'contact', 'regency', 'district', 'village'));
    }

    public function release($id)
    {
        $release = Release::findOrFail($id);

        $releases = Release::with('category')->latest()->get();
        $recents = Release::with('category')->latest()->limit(4)->get();
        $categories = ReleaseCategory::orderBy('name', 'ASC')->get();
        $comments = ReleaseComment::with('admin', 'asistant', 'dosen', 'lead', 'user')->where('release_id', $id)->get();
        $count = ReleaseComment::where('release_id', $id)->get()->count();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = $release->name;
        $name = Str::substr($release->file, -3);

        $shares = Share::page('http://127.0.0.1:8000/rilis/detail/'.$release->id, $title)
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->getRawLinks();
        
        return view('frontend.release.detail', compact('title', 'release', 'releases', 'recents', 'categories', 'comments', 'count', 'name', 'shares', 'contact', 'regency', 'district', 'village'));
    }

    public function dedications()
    {
        $dedications = CommunityDedication::with('dosen')->latest()->filter(request(['search']))->paginate(6)->withQueryString();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Pengabdian Masyarakat';

        return view('frontend.community-dedication.index', compact('dedications', 'title', 'contact', 'regency', 'district', 'village'));
    }

    public function dedication($id)
    {
        $dedication = CommunityDedication::findOrFail($id);

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = $dedication->name;
        $shares = Share::page('http://127.0.0.1:8000/pengabdian-masyarakat/detail/'.$dedication->id, $title)
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->getRawLinks();

        return view('frontend.community-dedication.detail', compact('dedication', 'shares', 'title', 'contact', 'regency', 'district', 'village'));
    }

    public function download()
    {   
        $trainings = LearningMaterial::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        $releases = DB::table('releases')
                        ->select('releases.name', 'releases.file')
                        ->where('releases.file', 'like', '%' . 'pdf' . '%')
                        ->orWhere('releases.file', 'like', '%' . 'zip' . '%')
                        ->get();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Unduhan';

        return view('frontend.download.index', compact('title', 'trainings', 'releases', 'contact', 'regency', 'district', 'village'));
    }

    public function contact()
    {   
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();
        $title = 'Kontak';
        
        return view('frontend.contact.index', compact('contact', 'regency', 'district', 'village', 'title', 'contact'));
    }

    public function profile()
    {
        $profile = Profile::find(1);

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Tentang Kami';

        return view('frontend.profile.index', compact('profile', 'title', 'contact', 'regency', 'district', 'village'));
    }

    public function structure()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Struktur Organisasi';

        return view('frontend.profile.structure', compact('title' , 'contact', 'regency', 'district', 'village'));
    }

    public function galleries(){
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $galleries = Gallery::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        $title = 'Gallery Laboratorium Multimedia';

        return view('frontend.gallery.index', compact('title', 'contact', 'regency', 'district', 'village', 'galleries'));
    }

    public function schedules()
    {   
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $schedules = Schedule::latest()->get();
        $title = 'Jadwal Laboratorium Multimedia';

        return view('frontend.schedules.index', compact('title', 'contact', 'regency', 'district', 'village', 'schedules'));
    }

    public function faq()
    {   
        $faqs = Faq::latest()->get();
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Frequntly Ask Question';

        return view('frontend.faq.index', compact('title', 'contact', 'regency', 'district', 'village', 'faqs'));
    }

    public function tools()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();
        $tools = Tool::orderBy('name', 'ASC')->filter(request(['search']))->paginate(6)->withQueryString();

        $title = 'Peralatan Laboratorium';

        return view('frontend.tools.index', compact('tools', 'title', 'contact', 'regency', 'district', 'village'));
    }

    public function subscribe(Request $request)
    {
        $customer = Customers::where('email', $request->email)->first();
        if($customer){
            $notification = array(
                'message' => 'Anda telah berlangganan',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }

        Customers::create($request->all());

        $notification = array(
            'message' => 'Terima kasih telah berlangganan',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
