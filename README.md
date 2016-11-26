PAGINATION CLASS

Add pagination to your mysql query.
This object helps you modify your mysql query and appends a limit base on the display limit you specify.

Sample Usage:
*Please refer to demo.php

Sample output:

F:\wamp\www\code-snippets\php\simple_pagination\demo.php:25:
object(yclPagination)[2]
  public 'no_pages' => float 2
  public 'next_page' => float 2
  public 'prev_page' => float 1
  public 'current_page' => float 2
  private 'db_start_point' => float 2
  private 'total_no_items' => int 4
  private 'max_no_rows' => int 2
  private 'query' => string 'SELECT * FROM users WHERE true=true' (length=35)
  private 'select_query' => string 'SELECT * FROM users WHERE true=true LIMIT 2,2;' (length=46)
F:\wamp\www\code-snippets\php\simple_pagination\demo.php:27:
array (size=2)
  0 => 
    object(stdClass)[4]
      public 'id' => string '14' (length=2)
      public 'email' => string 'popsana4u@live.com' (length=18)
      public 'phone' => string '' (length=0)
      public 'first_name' => string 'Popsana' (length=7)
      public 'other_name' => string 'Noble' (length=5)
      public 'last_name' => string 'Barida' (length=6)
      public 'password' => string '$2y$10$14jKvFUU5/Yn9WNwU1EPjODATbKNluGtPCPmmm.x9ZgF77tHzFI3K' (length=60)
      public 'created_at' => string '2016-11-11 13:46:32' (length=19)
      public 'updated_at' => string '2016-11-11 13:46:32' (length=19)
  1 => 
    object(stdClass)[5]
      public 'id' => string '15' (length=2)
      public 'email' => string 'popsana4u@livee.com' (length=19)
      public 'phone' => string '' (length=0)
      public 'first_name' => string 'Popsana' (length=7)
      public 'other_name' => string 'Noble' (length=5)
      public 'last_name' => string 'Barida' (length=6)
      public 'password' => string '$2y$10$vyV0zMGxUkDbsA0XMTQ.a..HUZQG6XSGn6imy9zWv0CCwP9H/xvKO' (length=60)
      public 'created_at' => string '2016-11-11 15:23:32' (length=19)
      public 'updated_at' => string '2016-11-11 15:23:32' (length=19)