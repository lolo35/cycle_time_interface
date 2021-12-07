<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CTDispatches extends Model {
    protected $table = "ct_dispatches";
    protected $fillable = ['line', 'part', 'dispatch_id', 'dispatch_status', 'amg'];
    protected $hidden = [];
}