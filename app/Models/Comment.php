<?php

namespace app\Models;

use framework\Model;

class Comment extends Model
{
    // content TEXT
    // author TEXT
    // email TEXT
    // post_id INTEGER
    // FOREIGN KEY(post_id) REFERENCES posts(id) ON DELETE CASCADE ON UPDATE CASCADE

    protected static $table = "comments";

    public function post()
    {
        return $this->belongs_to(Post::class, "post_id");
    }
}
