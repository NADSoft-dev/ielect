<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinksVotes extends Model
{
    public $timestamps = false;
    protected $table = 'votes_links';
    protected $fillable = ['link_table', 'kalfy', 'linkId', 'votes'];
}
