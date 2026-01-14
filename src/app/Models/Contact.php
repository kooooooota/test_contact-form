<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'tel1',
        'tel2',
        'tel3',
        'address',
        'building',
        'content',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
        $query->where('category_id', $category_id);
    }
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)) {
        $query->where('gender', $gender);
    }
    }
    
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
        $query->whereDate('created_at', $date);
    }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('first_name', 'like', '%' . $keyword . '%')->orwhere('last_name', 'like', '%' . $keyword . '%')->orWhereRaw('CONCAT(last_name, "", first_name) like ? ', '%' . $keyword . '%')->orWhereRaw('CONCAT(last_name, "　", first_name) like ? ', '%' . $keyword . '%')->orWhereRaw('CONCAT(last_name, " ", first_name) like ? ', '%' . $keyword . '%')->orWhereRaw('CONCAT(last_name, "  ", first_name) like ? ', '%' . $keyword . '%')->orwhere('email', 'like', '%' . $keyword . '%');
            
        }
        return $query;
    }
}
