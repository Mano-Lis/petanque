# petanque 


# Install

dokcer-compose up -d

symfony console doctrine:migrations:migrate

symfony serve -d



# Reproduce the bug in the form

Go to /admin 

Create 3 players 

go to /gameform

click on the 'add' button to create the first team - put the score at 13 (to avoid other validation constraints)
register two players
click on the add button to add another team - put the score between 0 and 12 (same reason than above)
register two players so as to have one duplicated player in each team
click on save

Now you can see that in the profiler the validation error is identified on the duplicated player thanks to the atPath() method 
But on the client side all the players are overlined in red.


