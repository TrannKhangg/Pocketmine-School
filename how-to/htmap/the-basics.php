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

<?php $currentPage = 'The Basics'; ?>
<?php include('sidebar.php'); ?>

<div id="the-basics" class="sidemain">
  <h3>The Basics</h3>
  <hr>
  <p>Here we will teach you all of the items of code that are required in order for the plugin to work.</p>
    <pre>
      <code class="php">

&lt;?php 

namespace ExampleName; 
//This should be the subfolder of the src directory. Based off of the folder structure example in "plugin.yml".

# Next, we need to add a "use" statement:

use pocketmine\plugin\PluginBase;

#Then, we type the class statement:
class Main extends PluginBase {  
/*
* This has a very simple format: 
* class (The File Name) extends PluginBase { 
*/

}

      </code>
    </pre>
  <h4>onEnable() Function</h4>
  <hr>
  <p>After the Class statement we add the onEnable() function and in it we add a message to the console everytime the plugin enables.</p>
    <pre>
      <code>
&lt;?php

namespace ExampleName;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase { 

  public function onEnable() {  // the onEnable() function
    $this->getLogger()->info("Plugin has been Enabled"); //A message every time the plugin enables
  }

}
      </code>
    </pre>
  <p>You can also use onLoad() and onDisable() function the same way.</p>
    <pre>
      <code>
  public function onLoad(){
    $this->getLogger()->info("Loading Plugin");
  }

  public function onDisable(){
    $this->getLogger()->info("Plugin Disabled");
  }
      </code>
    </pre>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../js/custom.js"></script>
<script src="../../js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

</body>
</html>