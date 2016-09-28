<?php
  class PSMQuery extends PSMExtra {

      # The testing function to see if PSM is working.
      public function test() {
        echo 'A FUNCTION TO TEST IF PSM IS WORKING';
      }

      # CALLABLE FUNCTION SETS.
        public function sQuery($statement, $binding, callable $callback) {
          # Getting the database handler.
            $handler = $this->handler;
          # Prepping the query. (prepare + bind).
            $query = $handler->prepare($statement);
            $query->execute($binding);
          # Looping the query.
            foreach ($query as $rows) $callback($rows);
        }

        public function query($statement, callable $callback, $user_supply = false) {
          # Building the vars needed for the main supply.
            $supply = [
              'time' => time(),
              'ip'   => $_SERVER['REMOTE_ADDR'],
              'psm'  => $this
            ];

          # Getting the database handler.
            $handler = $this->handler;
          # Setting up the query.
            $query = $handler->query($statement);
          # Looping the query.
          if ($user_supply === false) foreach ($query as $rows) $callback($rows, $supply);
            else foreach ($query as $rows) $callback($rows, $supply, $user_supply);
          }



      # STATIC FUNCTIONS FOR EXAMPLE (INSERT,DELETE) TYPE SQL COMMANDS.
        public function statQuery($statement) {
          # Getting the database handler.
            $db = $this->handler;
          # Doing the query.
            $db->query($statement);
        }

        public function sstatQuery($statement, $execution) {
          # Getting the database handler.
            $db = $this->handler;
          # Preparing and executing the query.
            $query = $db->prepare($statement);
            $query->execute($execution);
        }



      # FUNCTION SET FOR BUILDING QUERIES FOR OWN USAGE.
        public function retQuery($statement) {
          # Getting the database handler.
            $db = $this->handler;
            return $db->query($statement);
        }

        public function sretQuery($statement, $binds) {
          # Getting the database hadler.
            $db = $this->handler;
          # Preparing and executing the query to be returned.
            $query = $db->prepare($statement);
            return $query->execute($binds);
        }



        # RETURNING SET FUNCTIONS.
          public function gqs($statement) {
            # Gettomg the database handler.
              $db = $this->handler;
            # Looping the query to return the set.
              $query = $db->query($statement);
              foreach ($query as $row) return $row;
          }

          public function gsqs($statement, $binds) {
            # Getting the database handler.
              $db = $this->handler;
            # Preparing and Executing the query to then return the set.
              $query = $db->prepare($statement);
              $query->execute($binds);
            # Looping and returning set.
              foreach ($query as $row) return $row;
          }



        # GET ROW COUNT FUNCTIONS.
          public function grc($statement) {
            # Getting the database handler.
              $db = $this->handler;
            # Doing row count query.
              return $db->query($statement)->rowCount();
          }

          public function qgrc($query) {
            # Used with pair of retQuery to get a made query.
              return $query->rowCount();
          }

          public function gsrc($statement, $binds) {
            # Getting the database handler.
              $db = $this->handler;
            # Preparing and Executing the query then returning the row count.
              $query = $db->prepare($statement);
              $query->execute($binds);
                return $query->rowCount();
          }



        # DATABASE OVERALL INTERAcTION FUNCTIONS.
          public function connection() {
            return $this->handler;
          }

          public function close() {
            $this->handler = false;
          }

          public function glid() {
            # Getting the database handler.
              $db = $this->handler;
            # Retuning the last inserted ID.
              return $db->lastInsetId();
          }



        # QUICK STATEMENTS, MAKING QUERIES STATEMENTS EASIER.
          // public function select($table, callable $callback, $where = false) {
          //   # Getting the database handler.
          //     $db = $this->handler;
          //   # Initial construct and adding the where if needed.
          //     $statement = "SELECT * FROM $table";
          //     if ($where !== false) $statement .= ' WHERE '.$where;
          //   # Statement was constructed, looping the callback function giving it the params of the set.
          //     # Also making the query.
          //     $query = $db->query($statement);
          //     foreach ($query as $rows) $callback($rows);
          // }
          //
          // public function sselect($table, callable $callback, $where = false, $binds) {
          //   # Getting the database handler.
          //     $db = $this->handler;
          //   # Initial construct and adding the where if needed.
          //     $statement = "SELECT * FROM $table";
          //     if ($where !== false) $statement .= ' WHERE '.$where;
          //   # Statement was constructed, looping the callback function giving it the params of the set.
          //     # Also making and executing the query. (prepare->execute)
          //     $query = $db->prepare($statement);
          //     $query->execute($binds);
          //     foreach ($query as $rows) $callback($rows);
          // }

          # INSERT QUERY.
            public function insert($table, $inserts, $binds = false, $debug = false) {
              # Getting the database handler.
                $db = $this->handler;
              # Begining to construct the query.
                $statement = "INSERT INTO $table ";
              # Breaking up the arrays from key and value into parts.
              $cols = array(); $vals = array();
                foreach ($inserts as $key => $value) {
                  array_push($cols,$key);
                  if ($binds !== false) array_push($vals,$value);
                    else array_push($vals,'"'.$value.'"');
                }
               # Adding values to the statement.
                $statement .= '('.implode(',',$cols).') ';
                $statement .= 'VALUES ('.implode(',',$vals).')';
              # Management for if the user wants to use a binding paramater type statement. (or they don't)
                if ($binds !== false) { # Query Management for binding.
                  $query = $db->prepare($statement);
                  $query->execute($binds);
                } else { # Query management for no-binding.
                  $db->query($statement);
                }
              # Finished query.
              if ($debug) echo "<b>STATEMENT_TRACE: </b> $statement";
            }
          # UPDATE QUERY.
            public function update($table, $updates, $where = false, $binds = false, $debug = false) {
              # Getting the database handler.
                $db = $this->handler;
              # Begining to construct the query.
                $statement = "UPDATE $table SET ";
              # Breaking up the arrays from key and value into parts.
                $adds = array();
                  foreach ($updates as $col => $set) {
                    if ($binds === false) array_push($adds,"$col = \"$set\"");
                      else array_push($adds,"$col = $set");
                  }
                $statement .= implode(', ',$adds);
              # Management for where area.
                if ($where !== false) $statement .= " WHERE $where";
              # Query has been made, preparing + executing the array or building query base.
                if ($binds !== false) { # Building the query if they're using binds and prepared statements.
                  $query = $db->prepare($statement);
                  $query->execute($binds);
                } else { # Executing the query if the user isn't using prepared statements. (no binds)
                  $db->query($statement);
                }
                if ($debug) echo "<b>STATEMENT_TRACE: </b> $statement";
              }





      # Statement builder management.
      public $query = false;
        public $temp = array();
      public function select($table = 'test') {
        # Adding the select part to the query.
        $this->temp['table'] = $table;
          return $this;
      }

      public function col($cols = '*') {
        # Building the first part of th query to be ran.
        if (empty($this->temp['table'])) die('PSM Error: Building query and no table found.');
          else $table = $this->temp['table'];
        # Constructing the first part of the query.
        $query = "SELECT $cols FROM $table ";
          $this->temp['query_so_far'] = $query;
          $this->temp['cols'] = $cols;
        return $this;
      }

      public function where($where = 'id = 1', $raw = false) {
        # Going to add the WHERE statement to the query.
        if (!$raw) {
          $where .= ' ';
          # Alter the simple-input and add to temp for query.
          $where = preg_replace('/(.*?) = (.*?) /is', '$1 = \'$2\'',$where);
        } else {
          # The user wants the query WHERE to be a raw input and unaltered.
          $where = $where;
        }
        // Finished manipulating the string to get the correct looking answer.
        $this->temp['where'] = 'WHERE '.$where;
          $this->temp['query_so_far'] .= 'WHERE '.$where;
        # Adding the temp "where" to the temp variable as well as adding the where statement to the query that we have so far.
        return $this;
      }

      public function order($order = 'DESC') {
        # Going to take in keyword and change up the order set with that.
          if ($order == 'DESC' or $order == 'DESCENDING' OR $order = 'd') $add = "ORDER BY id DESC";
            else if ($order == 'ASC' OR $order == 'ASCENDING' or $order == 'a') $add = "ORDER BY id ASC";
        # Gotten the query addition for ordering the query, adding.
        $this->temp['order'] = $add;
          $this->temp['query_so_far'] .= ' '.$add;
        # Added.
        return $this;
      }

      public function print_query() {
        return $this->temp['query_so_far'];
      }

      public function build($build_type = 'bind', $binds = [':id' => 1]) {

        # Managing the binding building type.
        if ($build_type == 'bind') {
          $statement = $this->temp['query_so_far'];
          $query = $this->handler->prepare($statement);
            $query->execute($binds);
          # Geting the statement and the query and building. (build = $query)
            return $query;
        }

      }

      public function plus($table, $col, $id, $by) {
        # Will increase the table -> column by the by given variable.
        $set = $this->gsqs("SELECT $col FROM $table WHERE id = :id",[
          ':id' => $id
        ]);
        # Getting the am the user has selected.
        $am = $set[$col];
        $new = $am + $by;
        echo $am.' asd '.$by;
        # Going to insert the new value.
        $this->sstatQuery("UPDATE $table SET $col = :new WHERE id = :id",[
          ':new' => $new,
          ':id' => $id
        ]);
      }

      # Will see if the post request exists - if so do the callable function (or check that the value = the value).
      public function post($value, callable $do) { global $psm;
        $values = explode(' = ',$value);
        # Example input: [1] sub = value [2] sub
        if (count($values) == 2) {
          # Ex value = [sub = value]
          $postName = $values[0];
          $postValu = $values[1];
          if (isset($_POST[$postName]) && $_POST[$postName] == $postValu) {
            # Will call the function "do" with the PSM Var and $_POST.
            $do($psm, (object) $_POST);
          }
        } else {
          # Ex value = [sub]
          $postName = $values[0];
          if (isset($_POST[$postName])) {
            # Will call the fucntion "do" with the PSM Var and $_POST.
            $do($psm, (object) $_POST);
          }
        }
      }


      # Will check all post requests. - and run through the "post" function.
      public function posts($functions) {
        foreach ($functions as $value => $function) {
          $this->post($value, $function);
        }
      }






























      # THE START OF THE QUICK_PSM_LOAD FUNCTIONS.
        # This part of PSM is made for migrating databases.
        # "Migrating" - Making a string that can be stored to be used to quickly set up your database.
        public function save_details() {
          global $db, $authv, $use_auth, $use_database;
          # Making the data_string (adding the database information first)
          $data_string = "DB_{$db['host']}_{$db['db']}_{$db['user']}_{$db['pass']}";
          # If the user is using the auth script, will get the details and add to the data_string.
          if ($use_auth) $data_string .= " AUTH_{$authv['key']}_{$authv['algotype']}_{$authv['salt']}_{$authv['tableName']}_{$authv['usernameTable']}_{$authv['passwordTable']}";

          return $data_string;
        }
        public function data_string() { return $this->save_details(); }

        public static function parse_data_string($data_string) {
          if (count(explode(' ',$data_string)) == 2) {
            # String is to be parsed by DATABASE AUTH.
            $data_string = str_replace('DB_','',$data_string);
            $data_string = str_replace('AUTH_','',$data_string);
              $parts = explode(' ',$data_string);
            # We have the pieces of the database string as well as the auth pieces string.
            $db_pieces = explode('_', $parts[0]);
            $auth_pieces = explode('_', $parts[1]);
              $db = [
                'host' => $db_pieces[0],
                'db'   => $db_pieces[1],
                'user' => $db_pieces[2],
                'pass' => $db_pieces[3]
              ]; $auth = [
                'key' => $auth_pieces[0],
                'algotype' => $auth_pieces[1],
                'salt' => $auth_pieces[2],

                'tableName' => $auth_pieces[3],
                'usernameTable' => $auth_pieces[4],
                'passwordTable' => $auth_pieces[5]
              ];

              $generatedPsm = new PSM("{$db['host']} {$db['db']} {$db['user']} {$db['pass']}");
              $generatedAuth = new auth($generatedPsm);
                $generatedAuth->setup($auth['algotype'],$auth['salt'],$auth['key']);
                $generatedAuth->setupDatabase($auth['tableName'],$auth['usernameTable'],$auth['passwordTable']);
              # Returning the generated objects. (auth and psm)
              return [
                'psm' => $generatedPsm,
                'auth' => $generatedAuth
              ];
          } else { # FOR A DATABASE_ONLY RETURNED STRING FROM $PSM->SAFE_DETAILS() WHEN WAS USED.
            # String is to be parsed by DATABASE.
            $data_string = str_replace('DB_','',$data_string);
              $db_pieces = explode('_',$data_string);
            $db = [
              'host' => $db_pieces[0],
              'db'   => $db_pieces[1],
              'user' => $db_pieces[2],
              'pass' => $db_pieces[3]
            ];

            $generatedPsm = new PSM("{$db['host']} {$db['db']} {$db['user']} {$db['pass']}");
            # Returning the generated objects. (auth and psm)
            return [
              'psm' => $generatedPsm
            ];
          }
        }





















  } # End of the PSM Query class.









##
