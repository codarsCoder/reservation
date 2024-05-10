<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::user()->id)->get();
        $joined_events = Registration::where('user_id', Auth::user()->id)->with('event')->get();
        return view('home', compact('events', 'joined_events'));
    }

    public function create_event(Request $request)
    {
        // Formdan gelen verileri doğrulama
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $expireDate = $request->date.' '. $request->time; // '2022-12-31 12:00'; // Hedef tarih
        $expireDate = strtotime($expireDate);

        // Etkinlik oluşturulacak veriyi oluşturma
        $event = new Event();
        $event->user_id = Auth::user()->id;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->expire_at = $expireDate;

        // Veriyi veritabanına kaydetme
        $event->save();

        // Başarı mesajı oluşturma ve kullanıcıyı uyarma
        return redirect()->back()->with('success', 'Event created successfully.');
    }

    public function edit_event($id)
    {
        $event = Event::where('user_id', Auth::user()->id)->find($id);
        if (!$event) {
            abort(404);
        }
        return view('edit_event', compact('event'));
    }
    public function update_event(Request $request, $id)
    {
        $expireDate = $request->date.' '. $request->time; // '2022-12-31 12:00'; // Hedef tarih
        $expireDate = strtotime($expireDate);

        // Formdan gelen verileri görme
        $event = Event::where('user_id', Auth::user()->id)->find($id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->expire_at = $expireDate;

        // Veriyi veritabanına kaydetme
        $event->save();

        return view('edit_event', compact('event'));
    }

    public function delete_event($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();
        }

        $events = Event::where('user_id', Auth::user()->id)->get();
        $joined_events = Registration::where('user_id', Auth::user()->id)->with('event')->get();
        return view('home', compact('events', 'joined_events'));
    }

    public function all_events() {

        // Tüm etkinlikleri al
        $currentTimestamp = time();
        $all_events = Event::where('expire_at', '>=', $currentTimestamp)->get();

        // Kullanıcının satın aldığı etkinlikleri al
        $joined_events = Registration::where('user_id', Auth::user()->id)->pluck('event_id')->toArray();

        // Her etkinlik için kullanıcının kayıt durumunu kontrol et
        foreach ($all_events as $event) {
            // Kullanıcının satın aldığı etkinlikler arasında bu etkinlik var mı kontrol et
            if (in_array($event->id, $joined_events)) {
                // Kullanıcı bu etkinliğe kayıtlı, join bilgisini true olarak ayarla
                $event->joined = true;
            } else {
                // Kullanıcı bu etkinliğe kayıtlı değil, join bilgisini false olarak ayarla
                $event->joined = false;
            }
        }

        return view('all_events', compact('all_events'));
    }
}
