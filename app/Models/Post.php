<?php

namespace app\Models;

use framework\Model;

class Post extends Model
{
  // title TEXT
  // content TEXT
  // created_date TEXT
  // views INTEGER
  // category INTEGER
  // author INTEGER
  // FOREIGN KEY(author) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
  // FOREIGN KEY(category) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE

  protected static $table = "posts";

  public function comments()
  {
    return $this->has_many(Comment::class, "post_id");
  }

  public function category()
  {
    return $this->belongs_to(Category::class, "category");
  }

  public function user()
  {
    return $this->belongs_to(User::class, "author");
  }
}
