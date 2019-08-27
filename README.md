# Game-rental-web-application

## Website URL and Staff Area Login
- Website URL Link - http://seg-2018-cardinal.dx.am/public/game_area/pages/home.php

### Staff Area Login Credentials
- Secretary = Username - naharul, Password - 123456789
- Volunteer = Username - eugene, Password - 123456789

### Database Schema file path
- /LabProject/setup.sql

### Resources and Frameworks Used
- Bootstrap 4.0.0 (assist the styling)
- validation_functions.php and functions.php file from the video lecture on Lynda

### Solution produced for the following requirement
The Computer Gaming Society has a collection of CDs, DVDs and cartridges containing computer games for a range of platforms, including current and older gaming consoles. They rent these games to members of the society for a limited period (currently up to 3 weeks). Members can only be renting a limited number of games at any one time (currently 2). Members can ask for a limited number of 1-week extensions (currently no more than two 1-week extensions are allowed). Members who violate these rules and do not return games on time repeatedly (currently, on three occasions within a 12 month period), will be banned from renting games for a fixed period (currently 6 months). Members are expected to take good care of the games they are renting. If a game is returned damaged (e.g. a CD/DVD is scratched and no longer readable), the member is expected to refund the value of the game to the society and will not be allowed to rent games until they do so.

Members visit the society's library if they wish to rent a game. However, they have no way of knowing what games will be available at any one time because the collection is not currently available online. They also have no way of finding out whether a game they know the society has in its library is currently being rented out, other than going to the library in person. The society's secretary and library volunteers register rentals in an Excel spreadsheet. They have a separate spreadsheet to manage membership records. Communication takes place in person or via email. This makes it very difficult to track whether the society's rules on rentals are being adhered to. Tracking extensions, bans and refunds of damaged games is especially challenging. They would like your team to develop and deploy a web application to manage all the above using a LAMP technology stack.

The web application your team is developing should make it easy for the public to view and browse the society's extensive games collection. Ideally, there would be some ways of browsing or searching for games (e.g. by platform, type of game, release year, title, etc.), add detailed descriptions and some artwork for games, and link in ratings by reputable computer game review magazines.

The society's secretary and library volunteers should be able to complete all required administrative tasks described above, such as recording rentals, extending rentals (if allowed), manage membership records and access various reports, such as overdue items, outstanding fees, banned members, etc. The system should be able to enforce the society's current rules and limits on rentals. In addition, society's current secretary should be able to manage access rights (member/volunteer/secretary) of other users (note that while there is only one society secretary at any one time, he/she is replaced from time to time). The secretary should also be able to edit the current rules that apply.

The society has no clear idea of what the finished system might look like or what your team is able to implement in six weeks. It is understood that it is unrealistic for your team to implement a complete system that meets all the expectations outlined above fully. Your team has six weeks to develop a viable system that addresses the society's needs for a game rental management system as completely as feasible, under the constraints (time and available people) imposed on it. The team must focus on the society's core needs, as outlined in the description above, and on producing working software. The system ought to be designed well and coded cleanly, so that it is easy to expand in the future.

### Features Implemented Alongside Base Requirements
- Beautiful UI Design using Bootstrap.
- Members can browse video game collection and filter games by criteria.
- Members can view details of game, including artwork and also can see whether copies of the game is currently being rented out
- Login Validation needed for security in every pages in staff area (unless already logged in). Password hashed in database
- Validation checks in content management forms for staffs, so that staffs cannot accidently input invalid data.
- Date time picker to make it easier for staff to record dates for rental.
- Validation checks for rentals, so that a staff cannot accidently assign a rental to a member who isnt eligible.
- Various reports to enable staff members to get an overview of different aspects of rental and members.
- Staffs (Only secretaries) can change society rules from their side. The rules are immediately updated for members to see.
- Staffs (Only secretaries) can make changes to the current admin staffs.


  
