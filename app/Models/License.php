<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['item_id', 'item_name', 'buyer', 'purchase_code', 'license_type', 'purchase_date'])]
class License extends Model
{
}
