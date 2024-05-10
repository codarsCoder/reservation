<?php

namespace App\Http\Controllers\api;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiEventController extends Controller
{
    public function create_event(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Doğrulama başarısız ise hata mesajlarını döndür
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Etkinlik oluşturulacak veriyi oluşturma
        $event = new Event();
        $event->user_id = Auth::user()->id;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;

        // Veriyi veritabanına kaydetme
        $event->save();

        // Başarı mesajı oluşturma ve kullanıcıyı uyarma
        return response()->json(['message' => 'Event created successfully.'], 201);
    }

    public function update_event(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        if (!$request->has('id')) {
            return response()->json(['message' => 'Event id is required.'], 422);
        }
        
        $event = Event::where('user_id', Auth::user()->id)->find($request->id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;

        $event->save();

        return response()->json(['message' => 'Event updated successfully.'], 200);
    }

    public function delete_event(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['message' => 'Etkinlik kimliği (id) belirtilmemiş.'], 422);
        }

        $event = Event::find($request->id);
        if ($event) {
            $event->delete();
        }

        return response()->json(['message' => 'Event deleted successfully.'], 200);
    }

    public function my_events()
    {

        $events = Event::where('user_id', Auth::user()->id)->get();
        $joined_events = Registration::where('user_id', Auth::user()->id)->with('event')->get();

        return response()->json(['my_events' => $events, 'joined_events' => $joined_events], 200);
    }

    public function join_event(Request $request)
    {

        if (!$request->has('id')) {
            return response()->json(['message' => 'Event id is required.'], 422);
        }

        $event = Event::find($request->id);
        // Belirli bir etkinlik için kullanıcının kaydını kontrol ediyoruz
        $register = Registration::where('event_id', $request->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        // Eğer kullanıcı daha önce bu etkinliğe kayıt olmadıysa
        if (!$register && $event) {
            // Yeni bir kayıt oluştur
            $newRegistration = new Registration();
            $newRegistration->event_id = $request->id;
            $newRegistration->user_id = Auth::user()->id;
            $newRegistration->save();

        }
    }

}