<?php

namespace app\Models;

use framework\Model;

class UserLink extends Model
{
  // provider TEXT
  // link TEXT
  // user_id INTEGER
  // FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE

  protected static $table = "user_links";

  public function user()
  {
    return $this->belongs_to(User::class, "user_id");
  }
}
