# Ecommerce-Lottery-Auction

To Run the project:
  First, make the database using the SQL provided.
  Start a localhost using the command: php -S localhost:4000
  I am using Xampp, so start all the servers there and you are good to go.
  Enjoy

I made this website as part of my team project for a CSE course where our goal was a complete E-commerce Website.

To use the lottery, you need to create tiers, where u basically specify an item, stored in the database, and assign a discount that the user will get on that item if they win.
After creating multiple tiers, you can create a lottery by setting up a date and then assigning probabilities/weights to each tier.
Make sure you do not put multiple lotteries in one day.

After creating the lottery you can play that lottery in the specified date. The lottery wheel is made by just making a pi chart from the probabilities/weights and then rotated to a random degree. The tier the arrow lands on is the winning tier. The user will randomly get a prize from this tier. If there is a user database then you can easily store this prize and even restrict users from playing multiple times

Creating an auction is more straightforward. You can add a description, an image, a starting bid, and the date the auction will be live.

A user can make bids during the live period and the highest bidder will be stored in the database. Since I did not have a user database set up, I just made the user input their name, but you can easily make it so the user ID is stored in the database instead. You can also make it so a log of all bids is stored in a seperate database.

I also unit-tested the function that figures out the winner after spinning the lottery wheel since that is a vital part.

Hopefully, you can learn and even implement this project on your own.

Thank you for reading.
