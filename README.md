# [TUBETRACK] (http://tubetrack.pagodabox.com)
### One-click stats tracking for YouTube videos

TubeTrack is a tool for quick and easy tracking, sorting and comparing of YouTube videos in real-time.
Built with CodeIgniter, this app allows users to enter a list of YouTube video links they wish to keep track of. For each valid link, the corresponding video's information and statistics are retrieved from YouTube, and displayed alphabetically to the user for comparing and further sorting. Currently, the properties displayed on the results page are the videos':
* *Image thumbnail*
* *Title*
* *Views*
* *Likes*
* *Duration*

Of these, the user can sort the displayed videos by likes, views, duration and title (ie, alphabetically).

This tool makes the process of comparing the stats of several YouTube videos extremely easy. With just one click, the user can retrieve all information from the links entered and sort them, instead of manually visiting each link and manually noting down video information (for manual comparing later on).

Users also have the choice to save a list of (unlimited) links with TubeTrack so they do not have to repeatedly enter the same data for comparing each time. Each video list is assigned a unique TubeTrack ID, through which the users can retrieve their lists. A special update feature is added for saved lists, through which the video stats can be updated anytime with a single click.

In addition, saved lists can be shared with others through the URL: *http://tubetrack.pagodabox.com/track/retrieve/your_tubetrack_key*

**Note:** Since the app has to retrieve updated info from YouTube for all entries, the results page load time is directly proportional to the number of valid links entered.

## Features

* One-click stats comparison for all entered links
* Sort entries by likes, views, duration and title
* Ability to save a list of links for subsequent retrieval
* One-click update of rankings for all saved lists
* Ability to share saved lists
* jQuery validation of user input
* Page load time in footer for benchmarking

## Project Information

### Links

* Source: http://github.com/adi3/tubetrack
* Demo: http://tubetrack.pagodabox.com

### Stuff Used

* PHP, HTML/CSS, jQuery
* MySQL, HeidiSQL
* CodeIgniter Framework
* Eclipse IDE
* Pagoda Box, Git
* YouTube API

### Repository

This repository only holds files that are modified in or added to the standard CodeIgniter installation.

### To-do

* Show a link-list in the sidebar of videos ranked on the page
* Memcache data received from YouTube
* Optimize for mobile display

### Notice

TubeTrack is a free tool that can be used by anyone for any purposes (except illegal ones). I hold all copyrights to the current version of the app. If you have any feedback on the project, any requests for additional features, or any will to contribute to the app, I'd be very happy to hear from you.

## Developers

* Adi Singh [http://www.linkedin.com/in/adisin]