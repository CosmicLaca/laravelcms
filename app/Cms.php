<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;

class Cms extends Model {

    public function insertItem($data) {
        return DB::table('content')->insert($data);
    }

}
