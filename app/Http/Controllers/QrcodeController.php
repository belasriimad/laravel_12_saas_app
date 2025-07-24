<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Qrcode;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddQrcodeRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateQrcodeRequest;

class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qrcodes = auth()->user()->qrcodes()->paginate(10);
        return view('qrcodes.index',compact('qrcodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('qrcodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddQrcodeRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $qrcode = Qrcode::create($data);
        //update the qr code path
        $qrcode->qr_code_path = $this->saveQrCode($qrcode);
        $qrcode->save();
        //decrement the user number of qr codes
        auth()->user()->decrement('number_of_qrcodes');
        return to_route('qrcodes.index')->with('success','Qrcode added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Qrcode $qrcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qrcode $qrcode)
    {
        return view('qrcodes.edit')->with('qrcode',$qrcode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQrcodeRequest $request, Qrcode $qrcode)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $qrcode->update($data);
        //update the qr code path
        $qrcode->qr_code_path = $this->saveQrCode($qrcode);
        $qrcode->save();
        //decrement the user number of qr codes
        auth()->user()->decrement('number_of_qrcodes');
        return to_route('qrcodes.index')->with('success','Qrcode updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qrcode $qrcode)
    {
        if(auth()->user()->qrcodes->contains($qrcode)) {
            //remove the qr code image from the storage
            $this->removeQrCodeFromStorage($qrcode->qr_code_path);
            //delete the qr code from our database
            $qrcode->delete();
            return to_route('qrcodes.index')->with('success','Qrcode deleted successfully.');
        }else {
            return to_route('qrcodes.index')->with('error','Something went wrong try again later.');
        }
    }

    /**
     * Create and save the qr code in the storage
     */
    public function saveQrCode($qrcode)
    {
        //generate the qr code
        $builder = new Builder(
            writer: new PngWriter(),
            data: $qrcode->content,
            size: 150
        );
        
        $qrCode = $builder->build();

        //define the path
        $qrCodePath = 'qr_codes/'.$qrcode->id.'.png';
        
        //save the qr code
        Storage::disk('public')->put($qrCodePath, $qrCode->getString());

        //return the file path
        return 'storage/'.$qrCodePath;
    }

    /**
     * Remove the qr code from the storage
     */
    public function removeQrCodeFromStorage($qrcodeFile)
    {
        $path = public_path($qrcodeFile);
        if(File::exists($path)) {
            File::delete($path);
        }
    }
}
