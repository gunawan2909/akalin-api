<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['kind'] ?? false, function ($query, $kind) {
            return $query->where('kind', $kind);
        });
        $query->when($filters['status'] ?? false, function ($query, $status) {
            return $query->where('status', $status);
        });
        $query->when($filters['costomer_id'] ?? false, function ($query, $costomer_id) {
            return $query->where('costomer_id', $costomer_id);
        });
        $query->when($filters['consultant_id'] ?? false, function ($query, $consultant_id) {
            return $query->where('consultant_id', $consultant_id);
        });
        $query->when($filters['course'] ?? false, function ($query, $course) {
            return $query->where('course', $course);
        });
        $query->when($filters['university'] ?? false, function ($query, $university) {
            return $query->where('university', $university);
        });
        $query->when($filters['study_program'] ?? false, function ($query, $study_program) {
            return $query->where('study_program', $study_program);
        });
    }
}
