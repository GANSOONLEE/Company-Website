<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveUser extends Model
{
    // use HasFactory;

    protected $table = "approve_users";
    protected $primaryKey = "id";
    protected $fillable = [
        'email_address'
    ];
    
    public function cancel_approve(){
        $this->delete();
    }

    public function given_approve($email_address){

        $user = User::where('email_address', $email_address)
            ->first();
            
        if(!$user){
            return 'Unknown user!';
        }

        $approveUserDuplication = ApproveUser::where('email_address', $email_address)->first();

        if($approveUserDuplication){
            return 'This user are already approve';
        }

        $approveUser = ApproveUser::create([
            'email_address' => $email_address,
        ]);
    
        return $approveUser;
    }
}