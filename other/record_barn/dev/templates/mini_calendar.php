<?php

/*
 * This file builds a table-based calendar for inclusion on a web page.  It
 * takes the month_to_display as an argument.
 */

// see if there's an argument (or 3) passed in
// first arg should be month offset from current

if (isset($_GET[month]))
    $month = $_GET[month];
else
    $month = $current_month = date('n');
if (isset($_GET[year]))
    $year = $_GET[year];
else
    $year = $current_year = date('Y');
if (isset($_GET[size]))
    $size = $_GET[size];
else
    $size = "small";

/* print ("<span class=\"debug\"><p>mini_calendar DEBUG:<br />
  current_month = $current_month<br />
  current_year = $current_year</p></span>");
 */

print_calendar($month, $year, $size);

function print_calendar($month, $year, $size) {
    $days = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
    $day = 1;  // initialize day of month counter
    # tricky modulus math thanks to the months being numbered from 1 to 12...
    $back_month = (($month + 10) % 12) + 1;
    $back_year = ($month == 1) ? $year - 1 : $year;
    # the forward month, year are a bit more straightforward...
    $forward_month = ($month % 12) + 1;
    $forward_year = ($month == 12) ? $year + 1 : $year;
    
    # default to small calendar style
    $cal_class = ($size == "large") ?"lg_cal" : "small_cal";

    $begin_month = date('w t F', mktime(0, 0, 0,
                            $month, 1, $year));

    $begin_month = explode(" ", $begin_month);
    $first_day = $begin_month[0];  // first day as int
    $last_day = $begin_month[1];
    $month_alpha = $begin_month[2];

    print("<div class=\"$cal_class\"><table><tr><th id=\"no_borders\">
        <a href=\"calendar.php?month=$back_month&amp;year=$back_year&amp;size=$size\">&lt;&lt;</a></th>
        <th colspan=\"5\"><span class=\"large_clean\">$month_alpha $year</span></th>
        <th><a href=\"calendar.php?month=$forward_month&amp;year=$forward_year&amp;size=$size\">&gt;&gt;</a>
        </th></tr>");
    print("<tr>");
    // print day of week header cells
    for ($i = 0; $i < 7; $i++) {
        print("<th>$days[$i]</th>");
    }
    print("</tr>");  // close days of week header row

    print("<tr>");  // open new row for days
    for ($i = 0; $i < $first_day; $i++) {
        print("<td>&nbsp;</td>");
    }
    for ($i = $first_day; $i < 7; $i++) {
        // print rest of first week...
        print("<td>$day</td>");
        $day++;
    }
    print("</tr>");

// now $day is current day to print and we're at the start of the next week
// loop through rest of month
    while ($day <= $last_day) {
        // start new week
        print("<tr>");
        for ($i = 0; $i < 7; $i++) {
            if ($day <= $last_day) {
                print("<td>$day</td>");
                $day++;
            } else {
                print("<td>&nbsp;</td>");
            }
        }
        print("</tr>");
    }

    print("</table></div>");

    // link to change calendar size
    echo ("<p><a href=\"calendar.php?month=$month&amp;year=$year&amp;size=");
    if ($size == large)
        echo ("small\">Small Calendar</a></p>");
    else
        echo ("large\">Large Calendar</a></p>");
}

?>
