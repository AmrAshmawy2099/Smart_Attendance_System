<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Records;
use App\User;
use App\Card;
use App\Machine;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
class apicontroller extends Controller
{

    public function saverecordSecured (Request $req)
    {

        $encrypted_msg = base64_encode(hex2bin($req->card_serial));
        $mode='AES-128-ECB';
        $encryption_key='gp2021encryption';
        // dd(bin2hex(base64_decode(openssl_encrypt('38166xxxxxxxxxxx',$mode,$encryption_key,OPENSSL_ZERO_PADDING))));
        // dd(bin2hex(base64_decode($encrypted_msg)));
        // dd(openssl_decrypt($encrypted_msg,$mode,$encryption_key,OPENSSL_ZERO_PADDING));
        // dd(bin2hex(base64_decode(openssl_encrypt('12345xxxxxxxxxxx','AES-128-ECB','abcdefghijklmnop',OPENSSL_ZERO_PADDING))));
        $decrypted_msg = openssl_decrypt($encrypted_msg,$mode,$encryption_key,OPENSSL_ZERO_PADDING);
        // dd(Str::substr($decrypted_msg, 0, 5));
        $req->merge([
            "card_serial" => Str::substr($decrypted_msg, 0, 5),
        ]);

        $validator = $this->validateRecordData($req);
        if($validator->fails()){
            return response()->json($validator->errors()->all(),406);
        }
        $card = Card::where('serial_no',$req->card_serial)->first();
        $record = new Records;
        $record->user_code=$card->user_code;
        $record->room_id = $req->room_id;
        $record->machine_id = $req->machine_id;
        $record->uploaded_by = $req->uploaded_by;
        $record->card_id = $card->id;
        $record->body=$req->body;
        $record->save();
        return response()->json($record,201);


    }


    private function validateRecordData(Request $req){
        $Request_rules=array(
            'room_id'=>'required | exists:rooms,id,deleted_at,NULL',
            'machine_id'=>'required | exists:machines,id,deleted_at,NULL',
            'card_serial'=>'required | exists:cards,serial_no,deleted_at,NULL',
            'body'=>'nullable',
            'uploaded_by'=>'required |in:Machine,Student App,Admin App'
        );
        $validator=Validator::make($req->toArray(),$Request_rules);
        if ($validator->fails()){
            return $validator;
        }
         // check if this machine belongs to the given room id
        $machine = Machine::where('id',$req->machine_id)->first();
        // check the validity of the card
        $card = Card::where('serial_no',$req->card_serial)->first();

         $relations = array(
            'room_id'=> (int)$req->room_id,
            'machine_room_id' => $machine->room_id,
            'card_validity'=> $card->valid,
            'user_code' =>$card->user_code
         );

         $relations_rules = array(
            'card_validity'=>'accepted',
            'machine_room_id'=>'same:room_id',
            'user_code' => 'exists:users,code,deleted_at,NULL'

         );
         $validator=Validator::make($relations,$relations_rules,$messages = [
            'machine_room_id.same' => 'This Machine Doesnt Belong to the given room',
            'card_validity.accepted' => 'This Card is invalid',
            'user_code.exists' => 'User Deleted'
        ]);

        return $validator;
    }
    public function saverecord (Request $req)
    {
        // $encrypted_msg = base64_encode(hex2bin('3833643598b47f1bcc9d64bace913f8e'));
        // $mode='AES-128-ECB';
        // $encryption_key='abcdefghijklmnop';
        // // dd(bin2hex(base64_decode($encrypted_msg)));
        // dd(openssl_decrypt($encrypted_msg,$mode,$encryption_key,OPENSSL_ZERO_PADDING));
        // dd(bin2hex(base64_decode(openssl_encrypt('12345xxxxxxxxxxx','AES-128-ECB','abcdefghijklmnop',OPENSSL_ZERO_PADDING))));
        $validator = $this->validateRecordData($req);
        if($validator->fails()){
            return response()->json($validator->errors()->all(),406);
        }
        $card = Card::where('serial_no',$req->card_serial)->first();
        $record = new Records;
        $record->user_code=$card->user_code;
        $record->room_id = $req->room_id;
        $record->machine_id = $req->machine_id;
        $record->uploaded_by = $req->uploaded_by;
        $record->card_id = $card->id;
        $record->body=$req->body;
        $record->save();
        return response()->json($record,201);


    }

    // public function saverecordList (Request $req){
    //     $records = $req->records;
    //     $unsaved_Records=0;

    //     foreach ($records as $record){
    //         $ReqObject = new Request([
    //             "card_serial" => $record['card_serial'],
    //             "uploaded_by" =>$record['uploaded_by'],
    //             "room_id"=>$record['room_id'],
    //             "machine_id"=>$record['machine_id']
    //         ]);
    //         $status_code = $this->saverecord($ReqObject)->status();
    //         if($status_code == 406){
    //             $unsaved_Records=$unsaved_Records+1;
    //         }
    //     }
    //     if ($unsaved_Records == 0){
    //         return response()->json("Records Saved Successfully",201);
    //     }
    //     else{
    //         return response()->json($unsaved_Records + "Records are invalid ",406);
    //     }

    // }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user =User::where('email',$request->email)->first();
            $role = $user ->roles()->get()->pluck('name')->first();
            $card_serial=$user->cards()->where('valid','1')->get()->pluck('serial_no')->first();
            $mode = 'AES-128-ECB';
            $encryption_key = 'gp2021encryption';
            $encrypted_card_serial = NULL;
            if($card_serial != Null){
                $encrypted_card_serial = bin2hex(base64_decode(openssl_encrypt(Str::padRight($card_serial, 16, 'x'),$mode,$encryption_key,OPENSSL_ZERO_PADDING)));
            }


            return response()->json([
                'Role' => $role,
                'Card_Serial'=>$encrypted_card_serial,
                'Error'=>NULL
            ],200
            );
        }
        else{
            return response()->json([
                'Role' => NULL,
                'Card_Serial'=>NULL,
                'Error'=>'Invalid Username or Password'
            ],400);
        }

    }

}
