<?php

namespace app\Models;

use framework\Model;

class Category extends Model
{
  // name TEXT
  // description TEXT

  protected static $table = "categories";

  public function posts()
  {
    return $this->has_many(Post::class, "category");
  }
}
