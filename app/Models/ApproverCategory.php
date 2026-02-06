<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApproverCategory extends Model
{
    use HasFactory;

    protected $table = 'approver_categories';
    protected $fillable = ['nama_kategori', 'urutan', 'deskripsi', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function approvers()
    {
        return $this->hasMany(Approver::class, 'id_approver_category');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    public function getJumlahApproverAttribute()
    {
        if (!$this->relationLoaded('approvers')) {
            return $this->approvers()->where('is_active', true)->count();
        }
        return $this->approvers->where('is_active', true)->count();
    }
}
