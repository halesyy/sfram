<?php
  # SAFETY TEST!
    // To be implimented at a later date.
  # jQUERY PHP API.





    # GET API.
    if ($url->segment(2) !== false && $url->segment(2) == 'get') {
      if ($url->segment(3) !== false) $get = $url->segment(3);
        else $get = 'fail';
      # Testing the GET API.
      if ($get == 'test') {
        echo 'get test successful';
      }


      if ($get == 'fail') echo 'an error occoured in the API, did you set the type and the if statement correctly?';





      if ($get == 'file') {
        # Getting the file the user wants.
        $file = $url->segment(4);
          # Serving.
          require "backend/serve/$file.serve.php";
      }
      # Going to show the current prefered widgets.
      if ($get == 'reload-widget-pref') {
        if ($user->w('timetable')) $do['timetable'] = "checked";
          else $do['timetable'] = "0";
        if ($user->w('birthdays')) $do['birthdays'] = "checked";
          else $do['birthdays'] = "0";
        if ($user->w('assignments')) $do['assignments'] = "checked";
          else $do['assignments'] = "0";
        if ($user->w('termdates')) $do['termdates'] = "checked";
          else $do['termdates'] = "0";
        if ($user->w('reminders')) $do['reminders'] = "checked";
          else $do['reminders'] = "0";

        # Constructing the returning HTML.
        echo "
        <input id='checkbox-1' class='checkbox-custom' name='do-timetable' type='checkbox' {$do['timetable']}>
        <label for='checkbox-1' class='checkbox-custom-label'>Time Table</label> <br/>

        <input id='checkbox-2' class='checkbox-custom' name='do-birthdays' type='checkbox' {$do['birthdays']}>
        <label for='checkbox-2' class='checkbox-custom-label'>Birthdays</label> <br/>

        <input id='checkbox-3' class='checkbox-custom' name='do-assignments' type='checkbox' {$do['assignments']}>
        <label for='checkbox-3' class='checkbox-custom-label'>Assignments</label> <br/>

        <input id='checkbox-4' class='checkbox-custom' name='do-termdates' type='checkbox' {$do['termdates']}>
        <label for='checkbox-4' class='checkbox-custom-label'>Term Dates</label> <br/>

        <input id='checkbox-5' class='checkbox-custom' name='do-reminders' type='checkbox' {$do['reminders']}>
        <label for='checkbox-5' class='checkbox-custom-label'>Reminders</label> <br/>";
        # Finishing return.
      }



    }




    # POST API.
    if ($url->segment(2) !== false && $url->segment(2) == 'post') {
      if (isset($_POST['type'])) $post = $_POST['type'];
        else $post = 'fail';
      # Testing the GET API.
      if ($post == 'test') {
        echo 'post test successful';
      }

      # Making the POST object.
      $p = (object) $_POST;

      if ($post == 'fail') echo 'an error occoured in the API, did you set the type and the if statement correctly?';

      if ($post == 'change-widgets') {
        if (!isset($_SESSION['signedin'])) die('not logged in lol');
        # Gets the string (ex:1:1:1:1:1) and sorts.
        $wo = $p->widget_order;
        $wo = explode(':',$wo);

        # Making sure the users id is safe.
        if ($user->u('id') == "0") die('something went wrong');

        # Updating effectively.
        $psm->update('widgets',[
          'timetable' => '\''.$wo[0].'\'',
          'birthdays' => '\''.$wo[1].'\'',
          'assignments' => '\''.$wo[2].'\'',
          'termdates' => '\''.$wo[3].'\'',
          'reminders' => '\''.$wo[4].'\''
        ], 'userID = :uid', [
          ':uid' => $user->u('id')
        ], true);

        echo 'COMPLETED!';
      } #

      if ($post == 'gen-table') {
        $table_data = $p->table_data;

        # Generating the table.
        $tools->table($table_data);

        # Updating table.
        $psm->update('timetables',[
          'table_data' => ':table'
        ],'userID = :uid',[
          ':uid' => $user->u('id'),
          ':table' => $table_data
        ]);
      } #


      if ($post == 'add-friend') {
        if (empty($p->name) || empty($p->bday) || empty($p->link)) die("
          <div class='friend-container mdl-shadow--2dp'>
            <div class='friend-photo'>
              <img class='resize-image-25' src='https://img.ifcdn.com/images/460367ccc6ca9254e69caafeb1f998fd1114a3353f9058a25017dba6b75bf1d6_1.jpg' />
            </div>
            <div class='friend-name'>
              <h3>FAILED</h3>
            </div>
            <div class='friend-bday'>
              Never
            </div>
          </div>
        ");
        # Has the link, bday and name of who we're adding.
          $psm->insert('friends',[
            'userID' => ':uid',
            'friend_name' => ':name',
            'friend_bday' => ':bday',
            'friend_link' => ':link'
          ],[
            ':uid' => $user->u('id'),
            ':name' => $p->name,
            ':bday' => $p->bday,
            ':link' => $p->link
          ]);
          # Added to database.
          // echo $p->bday;
            if ($t->daysTill($p->bday)) {
              $d = "{$t->daysTill($p->bday)} days till birthday!";
            } else {
              $d = "Birthday has passed!";
            }
          # Returning a template of the new friend.
          echo "
            <div class='friend-container mdl-shadow--2dp'>
              <div class='friend-photo'>
                <img class='resize-image-25' src='{$p->link}' />
              </div>
              <div class='friend-name'>
                <h3>{$p->name}</h3>
              </div>
              <div class='friend-bday'>
                $d
              </div>
            </div>
          ";
      } #



      if ($post == 'add-ass') {
        # Management for user wanting to add a new assignment.
          $psm->insert('assreminders',[
            'userID' => ':uid',
            'ass_name' => ':name',
            'ass_duedate' => ':duedate',
            'completed' => '\'0\''
          ],[
            ':uid' => $user->u('id'),
            ':name' => $p->name,
            ':duedate' => $p->duedate
          ]);
        # Done query.
        echo 'done!';
      } #

      if ($post == 'ass--set-complete-state') {
        # Management for the user changing the assreminders completed state.
          $psm->update('assreminders',[
            'completed' => ':state'
          ],'id = :id',[
            ':state' => $p->to,
            ':id' => $p->id
          ]);
        # Return what to change it too.
          if ($p->to) echo 'Yes';
            else echo 'No';
      }












      #
    }
