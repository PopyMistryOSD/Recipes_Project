<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['package_name', 'status', 'redirect_url'])]
class AppConfig extends Model
{
}
