<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="calc.css"/>
    <title>Document</title>

<!-- toegevoegd door Toei -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../website/CSS CODES/homepagina.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

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
      <a class="nav-link" href="calc.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
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
          <a class="dropdown-item" href="../To do list/index.php">To do list</a>
          <a class="dropdown-item" href="../agenda/agenda.php">Agenda</a>
        </div>
      </li>
    </ul>
  </div>
</nav>



    <div class="calc">
        <form action="" method="post">
            <div class="input">
                <div class="head">

                    <label for="inp">CASIO</label>
                    <div class="mirror">

                    </div>
                </div>
                <input type="text" id="inp" name="display">
            </div>
            <div class="row">
                <input type="button" class="key" value="C" name="clear" onclick="display.value = '' ">
                <input type="button" class="key" value="&leftarrow;" name="del" onclick="display.value = display.value.toString().slice(0,-1)">
                <input type="button" value="%" name="mod" onclick="display.value +='%'">
                <input type="button" value="/" name="/" onclick="display.value +='/'">

            </div>
            <div class="row">
                <input type="button" value="7" name="7" onclick="display.value+='7'">
                <input type="button" value="8" name="8" onclick="display.value+='8'">
                <input type="button" value="9" name="9" onclick="display.value+='9'">
                <input type="button" value="*" name="x" onclick="display.value+='*'">

            </div>
            <div class="row">
                <input type="button" value="4" name="4" onclick="display.value+='4'">
                <input type="button" value="5" name="5" onclick="display.value+='5'">
                <input type="button" value="6" name="6" onclick="display.value+='6'">
                <input type="button" value="&minus;" name="-" onclick="display.value+='-'">

            </div>
            <div class="row">
                <input type="button" value="1" name="1" onclick="display.value +='1'">
                <input type="button" value="2" name="2" onclick="display.value +='2'">
                <input type="button" value="3" name="3" onclick="display.value +='3'">
                <input type="button" value="+" name="+" onclick="display.value +='+'">

            </div>
            <div class="row">
                <input type="button" value="0" name="0" onclick="display.value +='0'">
                <input type="button" value="00" name="00" onclick="display.value +='00'">
                <input type="button" value="." name="." onclick="display.value +='.'">
                <input type="button" class="eql" value="=" name="=" onclick="display.value = eval(display.value)">

            </div>
            
                <div class="end">
                    
                </div>
            

        </form>
    </div>


</body>

</html>