<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'question_id', 'mark'];

    public function employee () {
        return $this->belongsTo(Employee::class);
    }

    public function question () {
        return $this->belongsTo(Question::class);
    }
}
