<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sender;
use App\Models\Receiver;

class AddressBookController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function index($type = 'sender')
    {
        if($type == 'receiver' OR $type == 'receivers')
        {
            $addresses = Receiver::orderBy('name', 'asc')->simplePaginate(50);
        }
        else
        {
            $addresses = Sender::orderBy('name', 'asc')->simplePaginate(50);
        }

        $total = $addresses->count();
        
        return view('address_book.index')->with([
                'total' => $total,
                'type' => $type,
                'addresses' => $addresses,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        if($request->add_to_sender_confirmation != 1 && $request->add_to_receiver_confirmation != 1)
        {
            return back()->with('error_status', 'You need to specify the address book to save this contact.');
        }

        if($request->add_to_sender_confirmation == 1)
        {
            Sender::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        if($request->add_to_receiver_confirmation == 1)
        {
            Receiver::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        return back()->with('success_status', 'Contact saved!');
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
        $this->validate($request, [
            'type' => 'required',
            'email' => 'required|email',
        ]);
        
        if($request->type == 'receiver' OR $request->type == 'receivers')
        {
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:receivers,name,'.$id
            ]);

            $address = Receiver::find($id);
        }
        else
        {
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:senders,name,'.$id
            ]);

            $address = Sender::find($id);
        }

        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->address = $request->address;

        $address->save();

        return back()->with('success_status', 'Update saved');
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

    public function search(Request $request){

        $this->validate($request, [
            'type' => 'required',
            'search_term' => 'required|string|max:255'
        ]);

        if($request->type == 'receiver' OR $request->type == 'receivers')
        {
            $addresses = Receiver::where('name', 'like', '%'.$request->search_term.'%')->simplePaginate(50);
        }
        else
        {
            $addresses = Sender::where('name', 'like', '%'.$request->search_term.'%')->simplePaginate(50);
        }

        $total = $addresses->count();

        return view('address_book.search')->with([
            'type' => $request->type,
            'total' => $total,
            'search_term' => $request->search_term,
            'addresses' => $addresses
        ]);
    }
}
