<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    private $messenger_id;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'messenger_id', 'university_name', 'student_code', 'first_name', 'last_name', 'profile_pic', 'locale', 'gender'
    ];

    public function setMessengerId($messenger_id)
    {
        $this->messenger_id = $messenger_id;
    }

    public function exists()
    {
        return User::where("messenger_id", $this->messenger_id)->exists();
    }

    public function storeId()
    {
        User::create([
            'messenger_id' => $this->messenger_id
        ]);
    }

    public function updateMessengerInformation($json)
    {
        $data = json_decode($json);
        User::where('messenger_id', $this->messenger_id)->update([
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'profile_pic' => $data->profile_pic,
            'locale' => $data->locale,
            'gender' => $data->gender
        ]);
    }

    public function getUniversityName()
    {
        return User::where("messenger_id", $this->messenger_id)->first()->university_name;
    }

    public function updateUniversityName($university_name)
    {
        User::where("messenger_id", $this->messenger_id)->update([
            'university_name' => $university_name
        ]);
    }

    public function getStudentCode()
    {
        return User::where("messenger_id", $this->messenger_id)->first()->student_code;
    }

    public function updateStudentCode($student_code)
    {
        User::where("messenger_id", $this->messenger_id)->update([
            'student_code' => $student_code
        ]);
    }

    public function getFirstName()
    {
        return User::where("messenger_id", $this->messenger_id)->first()->first_name;
    }

    public function getLastName()
    {
        return User::where("messenger_id", $this->messenger_id)->first()->last_name;
    }

    public function getFullName()
    {
        return $this->getLastName() . " " . $this->getFirstName();
    }
}
