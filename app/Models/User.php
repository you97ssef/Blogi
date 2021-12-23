<?php

namespace app\Models;

use framework\Model;

class User extends Model
{
  // username TEXT
  // password TEXT
  // email TEXT
  // firstname TEXT
  // lastname TEXT
  // about TEXT
  // role INTEGER

  protected static $table = "users";

  public function links()
  {
    return $this->has_many(UserLink::class, "user_id");
  }

  public function posts()
  {
    return $this->has_many(Post::class, "author");
  }

  public function insert(): int
  {
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::insert();
  }
}
