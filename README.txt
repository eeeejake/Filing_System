``// README.txt

I am committing the project which I have been working on to help with filing silk screens at my job. The code is a simple file system for creating, deleting, and updating entries in a numbered library, with search functions. There are also several features including a Javascript price calculator and a PDF form to create invoices. The PHP scripts I have cobbled together from various sources, particulary David Powers, and my own Javascript and PHP which I intend to clean up and improve over time.


The repo contains a specific program, which connects to a database(which utilizes the table structure created by the provided SQL), so to use it one must apply the changes relative to the database and users. The current state of the program uses a login to allow an authenticated user to add and modify entries, while an un-authenticated user may only search the data by string, number, or date. There is also a built-in javascript program with price calculators specific to screen printing which I designed for my previous employers website. My goal is to make the code eventually user-friendly, and possibly later create a drupal module integrating the capabilities.

I believe this program can be useful for many applications, and is fairly simple to implement and understand. If anyone wants to adapt or improve it, I would appreciate the input.
