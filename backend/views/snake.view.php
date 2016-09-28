<!-- Lets make a simple snake game -->
<div id="paused_cover" style="display:none;position:absolute;z-index:2;text-align:center;">
  <a id="play" style="cursor:pointer;">Play</a> ——
  <a id="restart" style="cursor:pointer;">Restart</a> ——
  <a id="exit" href="http://intuor.net" style="cursor:pointer;color:black;text-decoration:none;">Exit</a>
  <br/>
  <font style="font-size:10px;">proudly made by jek</font>
</div>

<canvas id="canvas" width="450" height="450"></canvas>


<link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald" rel="stylesheet">

<script>
$(document).ready(function(){
      //Canvas stuff
      var canvas = $("#canvas")[0];
      var ctx = canvas.getContext("2d");
      var w = $("#canvas").width();
      var h = $("#canvas").height();
      var $menu = $('#paused_cover');

      // Will set the state of the game - playing / paused.
      var gameState = "paused";

      //Lets save the cell width in a variable for easy control
      var cw = 7; // Smaller = SMALLER FIELD. (5 = per-pixel piece)
      var d;
      var food;
      var score;

      //Lets create the snake now
      var snake_array; //an array of cells to make up the snake

      function init()
      {
        d = "right"; //default direction
        create_snake();
        create_food(); //Now we can see the food particle
        //finally lets display the score
        score = 0;

        // The code to align the play / exit buttons correctly.
        $menuSettings = {
          font_size: 40,
          padding:   20,
          font_fam:  'Oswald'
        };

        wid = w - (2 * $menuSettings.padding);
        margin_top = (h - ($menuSettings.font_size + 2 * $menuSettings.padding)) / 2;

        $('#paused_cover').css({
          'font-size':$menuSettings.font_size+'px',
          'padding':$menuSettings.padding+'px',
          'width':wid+'px',
          'margin-top':margin_top+'px',
          'font-family':$menuSettings.font_fam
        });

        paint();
      }
      init();


      function create_snake()
      {
        var length = 2; //Length of the snake
        snake_array = []; //Empty array to start with
        for(var i = length-1; i>=0; i--)
        {
          //This will create a horizontal snake starting from the top left
          snake_array.push({x: i, y:0});
        }
      }

      //Lets create the food now
      function create_food()
      {
        food = {
          x: Math.round(Math.random()*(w-cw)/cw),
          y: Math.round(Math.random()*(h-cw)/cw),
        };
        //This will create a cell with x/y between 0-44
        //Because there are 45(450/10) positions accross the rows and columns
      }
      // Will stop the game and if in the mode will play the game.
      function playPause() {



        if (gameState == "playing") { // RUN WHEN THE GAME JUST GOT PAUSED.
          clearInterval(game_loop);
          gameState = "paused";
          $menu.css({'display':'block'});

          ctx.fillStyle = "grey";
          ctx.fillRect(0, 0, w, h);
        } else if (gameState == "paused") { // RUN WHEN THE GAME JUST GOT RAN AGAIN.
          game_loop = setInterval(paint, 60);
          gameState = "playing";
          $menu.css({'display':'none'});
          // Adding the graphics or removing them.
        }
      }

      //Lets paint the snake now
      function paint()
      {
        //To avoid the snake trail we need to paint the BG on every frame
        //Lets paint the canvas now
        ctx.fillStyle = "#55AC3B";
        ctx.fillRect(0, 0, w, h);
        ctx.strokeStyle = "white";
        ctx.strokeRect(0, 0, w, h);

        //The movement code for the snake to come here.
        //The logic is simple
        //Pop out the tail cell and place it infront of the head cell
        var nx = snake_array[0].x;
        var ny = snake_array[0].y;
          // nx = 1, ny = 0
          // nx = 1, ny = 1,
          // nx = 1, ny = 2
            // THIS = DOWN. (y = p/1 = ++)
        //These were the position of the head cell.
        //We will increment it to get the new head position
        //Lets add proper direction based movement now
        if(d == "right") nx++;
        else if(d == "left") nx--;
        else if(d == "up") ny--;
        else if(d == "down") ny++;
        else if(d == "paused") {}
        // AS SHOWN HERE, if down - Will make ny go up

        //Lets add the game over clauses now
        //This will restart the game if the snake hits the wall
        //Lets add the code for body collision
        //Now if the head of the snake bumps into its body, the game will restart
        if(nx <= -1 || nx == w/cw || ny <= -1 || ny == h/cw || check_collision(nx, ny, snake_array))
        {
          // USER FAILED, RUN CODE HERE BEFORE RESTART!
          //restart game
          init();
          //Lets organize the code a bit now.
          return;
        }

        //Lets write the code to make the snake eat the food
        //The logic is simple
        //If the new head position matches with that of the food,
        //Create a new head instead of moving the tail
        if(nx == food.x && ny == food.y)
        {
          var tail = {x: nx, y: ny};
          // alert(tail.x+" "+tail.y);
          score++;
          //Create new food
          create_food();
        }
        else
        {
          var tail = snake_array.pop(); //pops out the last cell
          tail.x = nx; tail.y = ny;
        }
        //The snake can now eat the food.

        snake_array.unshift(tail); //puts back the tail as the first cell
        // Unshift = prepend to array

        for(var i = 0; i < snake_array.length; i++)
        {
          var c = snake_array[i];
          //Lets paint 10px wide cells
          paint_cell(c.x, c.y);
        }

        //Lets paint the food
        paint_cell(food.x, food.y);
        //Lets paint the score
        var score_text = score;
        ctx.font = '20px Oswald';
        ctx.fillText(score_text, 5, h-5);
        // ctx.fillText('TEST', h-40,w-5);
      }

      //Lets first create a generic function to paint cells
      function paint_cell(x, y)
      {
        ctx.fillStyle = "yellow";
        ctx.fillRect(x*cw, y*cw, cw, cw);
        ctx.strokeStyle = "yellow";
        ctx.strokeRect(x*cw, y*cw, cw, cw);
      }

      function check_collision(x, y, array)
      {
        //This function will check if the provided x/y coordinates exist
        //in an array of cells or not
        for(var i = 0; i < array.length; i++)
        {
          if(array[i].x == x && array[i].y == y)
           return true;
        }
        return false;
      }

      //Lets add the keyboard controls now
      $(document).keydown(function(e){
        var key = e.which;
        //We will add another clause to prevent reverse gear
        if(key == "37" && d != "right") d = "left";
        else if(key == "39" && gameState == "paused") playPause();
        else if(key == "40" && gameState == "paused") playPause();
        else if(key == "27") playPause();
        else if(key == "38" && d != "down") d = "up";
        else if(key == "39" && d != "left") d = "right";
        else if(key == "40" && d != "up") d = "down";
        else if(key == "82" && gameState == "paused") { init(); playPause(); }

        //The snake is now keyboard controllable
      })

      // Mangement for user clicking play. (in pause menu)
      $('#play').click(function(){
        playPause();
      });
      // Mangement for user clicking restart. (in pause menu)
      $('#restart').click(function(){
        init();
        playPause();
      });
})
</script>
