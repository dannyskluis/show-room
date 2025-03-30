<?php 

require 'db_conn.php';
require 'App/Todo.php';

$database = new Database();
$todo = new Todo($database->pdo);
$todos = $todo->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- toegevoegd door Toei -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="../website/CSS CODES/homepagina.css">

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/stylle.css">
    <style>
        .show-todo-section {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

<!-- toegevoegd door Toei -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../website/PHP CODES/homepage.php">HOME</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
      <a class="nav-link" href="../calculator/calc.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
          <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
          <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
          </svg>
      </a>

      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tools
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php">To do list</a>
          <a class="dropdown-item" href="../agenda/agenda.php">Agenda</a>
        </div>
      </li>
    </ul>
  </div>
</nav>



    <div class="main-section">
       <div class="add-section">
          <form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" 
                     name="title" 
                     style="border-color: #ff6666"
                     placeholder="Dit veld is verplicht" />
              <button type="submit">Toevoegen &nbsp; <span>&#43;</span></button>

             <?php }else{ ?>
              <input type="text" 
                     name="title" 
                     placeholder="Wat moet je doen?" />
              <button type="submit">Toevoegen &nbsp; <span>&#43;</span></button>
             <?php } ?>
          </form>
       </div>
       
       <div class="show-todo-section">
        <h2>Te doen</h2>
            <?php if($todos->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                     
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?> 
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time'] ?></small> 
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('app/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>