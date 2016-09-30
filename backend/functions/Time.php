<?php
  class time {
    # ALL TIME BASED FUNCTIONS.
      # Setting all numbers and months for easy-reference.
    public $months = [
      'jan' => 31,
      'feb' => 29,
      'mar' => 31,
      'apr' => 30,
      'may' => 31,
      'jun' => 30,
      'jul' => 31,
      'aug' => 31,
      'sep' => 30,
      'oct' => 31,
      'nov' => 30,
      'dec' => 31,

      'one' => 'jan',
      'two' => 'feb',
      'three' => 'mar',
      'four' => 'apr',
      'five' => 'may',
      'six' => 'jun',
      'seven' => 'jul',
      'eight' => 'aug',
      'nine' => 'sep',
      'ten' => 'oct',
      'eleven' => 'nov',
      'twelve' => 'dec'
    ];
    public $nums = [
      1 => 'one',
      2 => 'two',
      3 => 'three',
      4 => 'four',
      5 => 'five',
      6 => 'six',
      7 => 'seven',
      8 => 'eight',
      9 => 'nine',
      10 => 'ten',
      11 => 'eleven',
      12 => 'twelve'
    ];

    public function oldCountdown($date, $returnNum = 0) {
      // Gets the current day/month/year.
      $day = $date[0].$date[1];
      $month = $date[3].$date[4];
      $year = $date[6].$date[7].$date[8].$date[9];
      // Gets current times.
      $dayNow = date('d');
      $monthNow = date('m');
      $yearNow = date('Y');
      // Tells if it has passed yet.
      if ($month < $monthNow OR $month == $monthNow AND $day <= $dayNow) {
        $has_passed = true;
        if ($returnNum) return 0;
        return '<font style="color: #c21f1f;">Next Year</font>';
      }
      // End of telling it it's passed yet.
      $daysTill = ($month - $monthNow) * 30 + ($day - $dayNow);
      $weeksTill = floor($daysTill / 7);
      if ($returnNum) return $daysTill;
      return "<font style='color: #c21f1f'>$daysTill days ($weeksTill weeks) till day <br/> </font>";
  }
  public function daysToWeeks($days) { return floor($days / 7); }
















    public function daysTill($day, $month = false) {
      if ($month === false) {
        $day = $this->GNtoBN($day);
        $pieces = explode(' ',$day);
        $day   = $pieces[1];
        $month = $pieces[0];
      }
      date_default_timezone_set('Australia/Sydney');
      $month = str_replace(0,'',$month);
      # Current day.
      $day_now   = date('d');
      $month_now = date('m');
      $month_now = str_replace(0,'',$month_now);
      # All the days in each month.

      # Management for month-input.
      if (is_numeric($month)) {
        # Month given is numeric.
        $month_number = $month;
        $number_name  = $this->nums[$month];
        $month        = $this->months[$number_name]; # The name of the month.
      } else {
        # Month given isn't numeric.
        foreach ($this->months as $left => $right) {
          if ($right == $month) $month_name = $left;
        }
        foreach ($this->nums as $num => $numname) {
          if ($numname == $month_name) $month_number = $num;
        }
        $month = $month;
      }
      # Start of management


      if ($month_number == $month_now) {
        # Stops excess management, will work on the fact that the months are the same.
        // $days_in_month = $this->months[$month_name];
        // echo "$day - $day_now <br/>";
        if ($day_now >= $day) return 0;
          else return $day - $day_now;
      }


      # Now got the name of the number + the name of the month [first 3 letters].
      $current_number_name = $this->nums[$month_now];
      $current_month       = $this->months[$current_number_name];
      # Monthnum  = The date we're checking. - Monn = the current month, monthnow.
      if ($month_now > $month_number) return 0;
      # Getting the difference in months.
      $monthDiff = $month_number - $month_now;
      // echo "$monthDiff month difference";
      $loop_months_sum = [];
      for ($i = $month_now; $i <= $month_number; $i++) {
        $loop_number_name = $this->nums[$i];
        $loop_month_name  = $this->months[$loop_number_name];
        $loop_month_days  = $this->months[$loop_month_name];
        # Getting the number name -> Getting the month name -> Getting the month days.
        array_push($loop_months_sum,$loop_month_days);
        # Storing into an array.
      }
      $loop_returned_days = array_sum($loop_months_sum);
      # Management for removing current days and removing excess days for the month the user is requesting.
      $loop_returned_days -= $day_now;
      $loop_returned_days -= $this->months[$month] - $day;
      # Finally gotten the days.
      $days_till_x = $loop_returned_days;
      return $days_till_x;
    } # END OF COUNTDOWN FUNCTION.


    public function opDaysTill($month, $day) { return $this->daysTill($day, $month); }

    public function GNtoBN($str) {
      $s = ['January','Febuary','March','April','May','June','July','August','September','October','November','December'];
      $r = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
      # ^ Search and Replace arrays ^ v The loop to remove them v
      for ($i = 0; $i <= 11; $i++) {
        $str = str_replace($s[$i],$r[$i],$str);
      }
      # Returning the string.
      return $str;
    }


    #

  }
