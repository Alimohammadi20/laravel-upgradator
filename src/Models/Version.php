<?php

namespace Alimi7372\Upgradetor\Models\Version;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    protected $fillable = ['version','installed_at'];
}
