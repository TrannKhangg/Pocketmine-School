<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pocketmine Plugin School</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/25239cedf1.js" crossorigin="anonymous"></script>

  <link href="../css/custom.css" rel="stylesheet" type="text/css">
  <link href="../../css/ultra.css" rel="stylesheet" type="text/css">
  <link href="../../css/tomorrow-night-eighties.css" rel="stylesheet" type="text/css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148602502-2"></script>
  <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-148602502-2');
  </script>
</head>

<body>

<nav>
  <a class="mobile-nav"><i class="fas fa-bars"></i></a>
  <div class="navtitle">Pocketmine School</div>
  <a href="../../index.html">Home</a>
</nav>

<?php $currentPage = 'Commands'; ?>
<?php include('sidebar.php'); ?>

<div id="Commands" class="sidemain">
  <h3>Commands</h3>
  <hr>
  <p>Using commands in a plugin enchants your Plugin! Commands can automatically and easily do things for you!</p>
  <p>Ok lets start by adding the "use" statements for you can use commands.</p>
  <pre>
    <code>
// The Command
use pocketmine\command\Command;
      
// Person who does command
use pocketmine\command\CommandSender;
    </code>
  </pre>
  <p>To setup the command we going to use a public function and inside the function we will add the command, like this:</p>
  <pre>
    <code>
public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
  if($cmd->getName() == "test") { // In this case, we will make the command "/test"
    $sender->sendMessage("This Is A Test!"); // when the sender execute the command it sends the sender a message that says "This Is A Test".
  }
  return true;
}
    </code>
  </pre>
  <p>Here is another example of a command instead of sending a message it gives the sender 4 steaks and a message!</p>
  <pre>
    <code>
public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
  if($cmd->getName() == "test"){
    $sender->getInventory()->addItem(Item::get(364,0,4)); //364 = Item ID Value (in this case, 364 is steak)
    $sender->sendMessage("You have just recieved 4 steak!");
  }
  return true;
}
    </code>
  </pre>
  <p>What would happen if the CONSOLE was the command sender? How do we prevent the Console?</p>
  <p>To prevent the situation above we are going to use an if statement including "instanceof"</p>
  <pre>
    <code>
public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
  if($cmd->getName() == "test") {
    if(!$sender instanceof Player) { // Basically this checks if the Command Sender is NOT a player
      $sender->sendMessage("This Command Only Works for players! Please perform this command IN GAME!"); // For Console Command Sender
    } else { //if command sender is not a CONSOLE
      $sender->getInventory()->addItem(Item::get(364,0,4));
      $sender->sendMessage("You have just recieved 4 steak!");
    }
  }
  return true;
}
    </code>
  </pre>
  <p>Now that we know how to do "basic" commands, let's make the command even better by allowing the user to choose how many steaks he wants by using ARGUMENTS!</p>
  <p>We'll take a look at a variable that we added without knowing what it was... I'm talking about the <kbd>$args</kbd> variable.</p>
  <p>It basicly stores every single arguments you use in an array. But how is it stored? Like this:</p>
  <pre>
    <code>
  /command <$args[0]> <$args[1]> <$args[2]> <$args[3]> ...
    </code>
  </pre>
  <p><kbd>Warning: Arrays always starts from 0 !</kbd></p>
  <pre>
    <code>
public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
  if($cmd->getName() == "test") {
    if(!$sender instanceof Player){
       $sender->sendMessage("This Command Only Works for players! Please perform this command IN GAME!");
    } else {
       $sender->getInventory()->addItem(Item::get(364,0,$args[0])); // We choose the first argument as the count !
        $sender->sendMessage("You have just recieved". count($args[0]) . " steak!");
    }
  }
  return true;
}
    </code>
  </pre>
  <p>As you can see, now we can use the /test &lt;steaks number&gt; and it will give us the number of steaks we want!</p>
  <p>But wait, what if the user doesn't enter the argument? The command won't work! To solve that issue, we need to add a parser to check if no argument "0" was entered, and if that's the case, "creating" it.</p>
  <p>We'll use function <a href="http://php.net/manual/en/function.isset.php">isset</a> which allows us to check if a variable is defined. Let's what this give use in our code !</p>
  <pre>
    <code>
public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
  if($cmd->getName() == "test") {
    if(!$sender instanceof Player) {
      $sender->sendMessage("This Command Only Works for players! Please perform this command IN GAME!");
    } else {
      if(!isset($args[0])) { // Check if argument 0 isn't defined.
        $args[0] = 4; // Defining $args[0] with value 4 this means giving the player 4 steaks
      }
      $sender->getInventory()->addItem(Item::get(364,0,$args[0]));
      $sender->sendMessage("You have just recieved" .count($args[0]). " steak!");
    }
  }
  return true;
}
    </code>
  </pre>
  <p>But what if the user don't enter a number? And even if it's a number, what if it's negative?</p>
  <p>We also need to check this in our code! We will use a new function <a href="http://php.net/manual/en/function.is-int.php">is_int</a> which will allow us to check if a variable is an integer.</p>
  <pre>
    <code>
public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
  if($cmd->getName() == "test") {
    if(!$sender instanceof Player){
      $sender->sendMessage("This Command Only Works for players! Please perform this command IN GAME!");
    } else {
      if(!isset($args[0]) or (is_int($args[0]) and $args[0] > 0)) { // Check if argument 0 is an integer and is more than 0.
        $args[0] = 4; // Defining $args[0] with value 4 this means giving the player 4 steaks
      }
      $sender->getInventory()->addItem(Item::get(364,0,$args[0]));
      $sender->sendMessage("You have just recieved" .count($args[0]). " steak!");
    }
  }
  return true;
}
    </code>
  </pre>
  <p>And that's it! You made your first command with arguments!</p>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../js/custom.js"></script>
<script src="../../js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

</body>
</html>