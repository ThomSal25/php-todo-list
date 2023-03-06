<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\listEntry;

class TodoListController extends Controller
{
    //
    public function index(){
        // show all ListEntries
        // return view('welcome', ['listEntries' => listEntry::all()]);
        // show all, which are not complete
        return view('welcome', ['listEntries' => listEntry::where('is_complete', 0)->get()]);
    }

    public function saveItem(Request $request){
        // \Log::info(json_encode($request->all()));
        // neues Listen-Element erstellen
        $newListEntry = New listEntry;
        $newListEntry->name= $request->listEntry;
        $newListEntry->is_complete = 0;
        $newListEntry->save();
        return redirect('/');
    }

    public function markComplete($id){
        // \Log::info($id);
        // ListElement updaten
        $ListEntry = listEntry::find($id);
        // \Log::info($ListEntry);
        $ListEntry->is_complete = 1;
        $ListEntry->save();
        return redirect('/');
    }
}
