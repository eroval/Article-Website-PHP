<?php

namespace App\Models;

use App\Traits\Uuid_trait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Uuid_trait;
    use HasFactory;
}
