<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shipment;
use App\Models\Status;
use App\Models\Sender;
use App\Models\Receiver;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $active_shipments = Shipment::where('stage', '5')->count();
        $pending_shipments = Shipment::where('stage', '<=', '4')->count();
        $completed_shipments = Shipment::where('stage', '>=', '6')->count();

        $statuses = Status::orderBy('name', 'asc')->get();
        $senders = Sender::orderBy('name', 'asc')->get();
        $receivers = Receiver::orderBy('name', 'asc')->get();

        $all_shipments = Shipment::count();

        $shipments = Shipment::orderBy('created_at', 'asc')->limit(10)->get();

        return view('home')->with([
            'active_shipments' => $active_shipments,
            'pending_shipments' => $pending_shipments,
            'completed_shipments' => $completed_shipments,
            'statuses' => $statuses,
            'senders' => $senders,
            'receivers' => $receivers,
            'all_shipments' => $all_shipments,
            'shipments' => $shipments,
        ]);;
    }
}
