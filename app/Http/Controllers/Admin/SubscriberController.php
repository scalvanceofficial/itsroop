<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Carbon;

class SubscriberController extends Controller
{

    public function index()
    {
        return view('Admin.Subscribers.index');
    }

    public function data(Request $request)
    {
        $query = Subscriber::where('id', '!=', 0);

        return DataTables::eloquent($query)
            ->editColumn('datetime', function ($subscriber) {
                return Carbon::parse($subscriber->created_at)
                    ->setTimezone('Asia/Kolkata')
                    ->format('d-m-Y') . ' || ' . Carbon::parse($subscriber->created_at)
                    ->setTimezone('Asia/Kolkata')
                    ->format('h:i A');
            })
            ->editColumn('email', function ($subscriber) {
                return $subscriber->email;
            })
            ->addColumn('action', function ($subscriber) {
                return '<span class="badge bg-success">Subscribed</span>'; // You can customize this
            })
            ->addIndexColumn()
            ->rawColumns(['datetime', 'email', 'action']) // make sure 'action' is included
            ->setRowId('id')
            ->make(true);
    }

    public function list()
    {
        $subscriber = Subscriber::all();
        return response()->json([
            'status' => 'success',
            'list' => $subscriber
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function show(Subscriber $subscriber)
    {
        //
    }

    public function edit(Subscriber $subscriber)
    {
        //
    }

    public function update(Request $request, $subscriber)
    {
        //
    }

    public function destroy(Subscriber $subscriber)
    {
        //
    }
}
