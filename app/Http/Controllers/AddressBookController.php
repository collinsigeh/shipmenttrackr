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
