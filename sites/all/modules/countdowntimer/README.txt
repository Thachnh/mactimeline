// $Id: README.txt,v 1.2 2010/03/09 23:26:16 webmaster Exp $

-------------- OVERVIEW -------------------------------------------
The countdowmtimer module provides a timer implemented through javascript
which gives you a dynamic countdown/up (second-by-second) to a certain date 
and time.  The Countdown Timer Module uses the onload event then dynamically 
searches content/blocks/teasers for certain css classes and then injects itself.
You can configure timer settings on the /admin/settings/countdowntimer page.
You can also format each timer differently using the individual timer overrides.



-------------- INSTALLING -----------------------------------------
countdowntimer can be installed simply by activating the module.
There are no module dependencies.
There are no table components.



-------------- NODE USAGE ----------------------------------------
1. create a new node with 
   -input format set to an html that allows span tags, this is usually full html.
   -add a timer span with the appropriate formatting (from the examples below).
   -your timer should now work (unless you exluded this page in the admin settings).


-------------- BLOCK USAGE ----------------------------------------
1. Make sure admin setting for Javascript load option is set to: ALL Pages (easiest).
2. create a new block with 
   -input format set to an html that allows span tags, this is usually full html.
   -add a timer span with the appropriate formatting (from the examples below).
   -your timer should now work (unless you exluded this page in the admin settings).

-------------- CLOCK USAGE ----------------------------------------
1. Make sure the Javascript load option supports where you want 
   your clock.
2. add a clock span to a node or a block:  

<span class="js-clock"></span>

NOTE: the clock doesn't support any overrides or settings 
      other than 12 or 24 hour at this time (admin page).

-------------- EXAMPLES -------------------------------------------

Example 1
<span class="countdowntimer">Not too many days left until Feb 17! (this shows until timer initializes or for non-js folks)
 <span style="display:none" class="datetime">2010-02-17T09:30:00-08:00</span> 
</span>


Example 2
<span class="countdowntimer">Wow, a lot of time has passed since the conference. (this shows until timer initializes or for non-js folks)
 <span style="display:none" class="datetime">2007-02-26T09:30:00-08:00</span> 
 <span style="display:none" class="dir">up</span>
</span>


Example 3
<span class="countdowntimer">Don't be late!
 <span style="display:none" class="datetime">2009-02-26T09:30:00Z</span> 
 <span style="display:none" class="format_num">1</span>
</span>


Example 4
<span class="countdowntimer">Count Down
 <span style="display:none" class="datetime">2009-02-26T09:30:00-05:00</span> 
 <span style="display:none" class="dir">down</span>
 <span style="display:none" class="format_txt"><em>(%dow% %moy%%day%)</em><br>%days% days + %hours%:%mins%:%secs%</span>
 <span style="display:none" class="threshold">4</span>
 <span style="display:none" class="complete">Custom Timer Complete Statement</span>
</span>

IMPORTANT: If you have a format_num and a format_txt in a timer, the format_txt
value will trump the format_num value.



-------------- OUTPUT FORMAT ---------------------------------------
The display of the actual timer is configurable in the Site configuration 
admin menu: countdowntimer.

Currently supported replacement values are:
%day%   - Day number of target date (0-31)
%month% - Month number of target date (1-12)
%year%  - Year number of target date (4 digit number)
%dow%   - Day-Of-Week (Mon-Sun)
%moy%   - Month-Of-Year (Jan-Dec)

%years% - Years from set date(integer number)
%ydays% - (Days - Years) from set date(integer number)

%days%  - Total Days from set date (integer number)

%hours% - (Hours - Days) from set date (integer number, zero padded)
%mins%  - (Minutes - Hours) from set date (intger number, zero padded)
%secs%  - (Seconds - Minutes) from set date (integer number, zero padded)

%hours_nopad% - (Hours - Days) from set date (integer number, no padding)
%mins_nopad%  - (Minutes - Hours) from set date (intger number, no padding)
%secs_nopad%  - (Seconds - Minutes) from set date (integer number, no padding)




-------------- CAVEATS ---------------------------------------------
If a daylight saving time shift should occur in either the client's tz or
the target's tz between the current date/time and your target datetime,
you could be off by one hour until you pass the point of conversion.



-------------- SCHEMA FOR MICROFORMAT ------------------------------
The countdowntimer schema consists of the following:

    * countdowntimer
          o datetime. required. ISO8601 absolute date time. YYYY-MM-DDThh:mm:ssTZD (ie 1997-07-16T19:20:30-05:00)
          o dir. optional. up | down
          o format_num. optional. integer [1-3]
          o format_txt. optional. text.
          o threshold. optional. integer [1-n]. minutes.
          o complete. optional. text.
          o tc_redir. optional. text. Redirects to a url upon timer completion.
          o tc_msg.   optional. text. Pops up a message box upon timer completion.
          