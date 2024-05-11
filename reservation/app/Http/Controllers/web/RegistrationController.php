<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function join_event($id)
    {


        // Geri dönüş için sayfaya data hazırla
        $all_events = Event::all();

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

        //Etkinlik kayıt
        $event = Event::find($id);
        // Belirli bir etkinlik için kullanıcının kaydını kontrol ediyoruz
        $register = Registration::where('event_id', $id)
                                 ->where('user_id', Auth::user()->id)
                                 ->first();

        // Eğer kullanıcı daha önce bu etkinliğe kayıt olmadıysa
        if (!$register && $event) {
            // Yeni bir kayıt oluştur
            $newRegistration = new Registration();
            $newRegistration->event_id = $id;
            $newRegistration->user_id = Auth::user()->id;
            $newRegistration->save();

            $success = 'You have successfully registered for this event.';

            return view('all_events', compact('all_events', 'success'));
        } else {
            $error = 'You have already registered for this event.';

            return view('all_events', compact('all_events', 'error'));
        }
    }

    // unjoin_event
    public function unjoin_event($id)
    {
        $register = Registration::where('event_id', $id)
                                 ->where('user_id', Auth::user()->id)->first();

        if ($register) {
            $register->delete();
        }
        $events = Event::where('user_id', Auth::user()->id)->get();
        $joined_events = Registration::where('user_id', Auth::user()->id)->with('event')->get();
        return view('home', compact('events', 'joined_events'));
    }

}
