<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pay;

use Illuminate\Support\Facades\Auth;
class PayController extends Controller
{
      public function index()
    {
        $pays = Pay::where('user_id', Auth::id())->latest()->get();
        return view('users.Pay', compact('pays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'period' => 'required'
        ]);

        Pay::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'period' => $request->period
        ]);

        return back()->with('success','Pay Added');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'period' => 'required'
        ]);

        Pay::find($id)->update([
            'amount' => $request->amount,
            'period' => $request->period
        ]);

        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Pay::find($id)->delete();
        return back()->with('success','Deleted');
    }
}
