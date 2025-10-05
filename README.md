# hostel-check-website
A web app for managing hostel bookings, check-ins, complaints, and e-outpass requests, aimed at simplifying hostel administration and improving user experience.
hostel-check/
│-- index.php                   # Home page
│-- config.php                  # Database connection & session start
│-- login.php                   # Login page for students/admin
│-- logout.php                  # Logout script
│-- css/
│   └-- style.css               # Basic styles
│-- js/                         # JavaScript files (currently empty)
│-- images/                     # Images (currently empty)
│-- includes/
│   ├-- header.php              # Header include (navigation, opening HTML)
│   └-- footer.php              # Footer include (closing HTML)
│-- admin/
│   ├-- dashboard.php           # Admin dashboard
│   ├-- view_bookings.php       # Admin view all bookings
│   ├-- manage_students.php     # Placeholder for student management
│   ├-- view_complaints.php     # Admin view all complaints
│   ├-- resolve_complaint.php   # Mark complaint as resolved
│   ├-- manage_outpass.php      # Admin view all outpass requests
│   └-- update_outpass.php      # Approve/reject outpass requests
│-- students/
│   ├-- dashboard.php           # Student dashboard
│   ├-- book_room.php           # Book a room
│   ├-- submit_complaint.php    # Submit complaints
│   └-- request_outpass.php     # Request outpass
│-- bookings/                    # Can add future check-in/check-out pages
│-- complaints/                  # Can add student complaint pages if separate
└-- e-outpass/                   # Can add student outpass pages if separate
