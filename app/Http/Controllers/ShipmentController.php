<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sender;
use App\Models\Receiver;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $senders = Sender::orderBy('name', 'asc')->get();

        return view('shipments.create')->with('senders', $senders);
    }

    /**
     * Step one (1) of creating New shipment
     *  -1- check for sender details.
     *  -2- create order in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function existingsender(Request $request)
    {
        $this->validate($request, [
            'select_sender' => 'required|min:1'
        ]);

        $sender = Sender::find($request->select_sender);
        
        if(!$sender)
        {
            return back()->with('error_status', 'Invalid user selection.');
        }
        
        return redirect()->route('shipments.create_step2', $sender);
    }

    /**
     * Step one (1) of creating New shipment
     *  -1- check for and save sender details.
     *  -2- create order in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newsender(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:senders',
            'email' => 'required|max:255|email'
        ]);
        
        $sender = Sender::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('shipments.create_step2', $sender);
    }

    /**
     * Display the step2 shipment creation form for receiver details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_step2(Sender $sender)
    {
        $receivers = Receiver::orderBy('name', 'asc')->get();

        return view('shipments.create_step2')->with([
                'sender' => $sender,
                'receivers' => $receivers
            ]);
    }

    /**
     * Step one (1) of creating New shipment
     *  -1- check for sender details.
     *  -2- create order in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function existingreceiver(Request $request)
    {
        $this->validate($request, [
            'sender_id' => 'required|min:1',
            'select_receiver' => 'required|min:1'
        ]);

        $sender = Sender::find($request->sender_id);
        if(!$sender)
        {
            return redirect()->route('shipments.create');
        }
        
        $receiver = Receiver::find($request->select_receiver);
        if(!$receiver)
        {
            return back()->with('error_status', 'Invalid user selection.');
        }
        
        return redirect()->route('shipments.create_step3', [
                'sender' => $sender, 
                'receiver' => $receiver
            ]);
    }

    /**
     * Step two (2) of creating New shipment
     *  -1- check for and save receiver details.
     *  -2- create order in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newreceiver(Request $request)
    {
        $this->validate($request, [
            'sender_id' => 'required|min:1',
            'name' => 'required|max:255|unique:receivers',
            'email' => 'required|max:255|email'
        ]);

        $sender = Sender::find($request->sender_id);
        if(!$sender)
        {
            return redirect()->route('shipments.create');
        }
        
        $receiver = Receiver::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        return redirect()->route('shipments.create_step3', [
                'sender' => $sender, 
                'receiver' => $receiver
            ]);
    }

    /**
     * Display the step2 shipment creation form for receiver details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_step3(Sender $sender, Receiver $receiver)
    {

        return view('shipments.create_step3')->with([
                'sender' => $sender,
                'receiver' => $receiver
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
