<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

function incrementPostViews($postId)
{
   return DB::table('posts')->where('id', $postId)->increment('views');
}
