<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'students';
    public $timestamps = false;
    protected $primaryKey = 'studentID';

// column sa table

    protected $fillable = [
    'studentID','studentFname', 'studentLname', 'studentMname'
    ];
}