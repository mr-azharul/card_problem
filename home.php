  <?php

        //Function for command line
  function cmd()
  {
    $username = ($_POST['user']);

    //Database connection
    $host = "localhost";
    $dbuser = "root";
    $pass = "";
    $db = "card";

    $conn = mysqli_connect($host,$dbuser,$pass,$db);

    if($username == "show users")
    {
      $sql = "SELECT user, yellow, red FROM get_card";
      $result = mysqli_query($conn,$sql);

      if(mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result))
        {
        echo "Name: ".$row["user"]. " - Yellow Cards: " . $row["yellow"]. " - Red Cards: " . $row["red"]. "<br>";
        }
      }
      else
      {
        echo "Nothing on Database!";
      }
    }
    else
    {
      call();
    }
  }

        //Calling Function

  function call()
  {
        //Get user Input
    $username = ($_POST['user']);
    $one = 1;

        //Include time file
    date_default_timezone_set("Asia/Dhaka");
    $c = strtotime("now");
    $starttime = date("Y:m:d h:i:sa",$c);
    $d = strtotime("+10 minutes");
    $endtime = date("Y:m:d h:i:sa",$d);


        //String to Array
    $textarr = explode(" ",$username,3);
    $name = $textarr[0];
    $gr = $textarr[1];
    $cause = $textarr[2];

        //Database connection
    $host = "localhost";
    $dbuser = "root";
    $pass = "";
    $db = "card";

    $conn = mysqli_connect($host,$dbuser,$pass,$db);

        //Give card to user
    $usget = "SELECT user FROM get_card WHERE user = '$name'";
    $result = mysqli_query($conn,$usget);

    if(mysqli_num_rows($result) > 0)
      {
        $add = "UPDATE get_card SET cause='$cause' WHERE user='$name'";
        if(mysqli_query($conn,$add))
        {
          if($gr == "Get" || $gr == "get")
            {
                $chyellow = "SELECT yellow FROM get_card WHERE user='$name'";
                $reyellow = mysqli_query($conn,$chyellow);

                $row = mysqli_fetch_assoc($reyellow);

                if($starttime <= $endtime)
                {
                  if($row['yellow'] == $one)
                    {
                      $mkye = "UPDATE get_card SET yellow='0' WHERE user='$name'";
                      if(mysqli_query($conn,$mkye))
                      {
                        red_card();
                      }
                      else
                      {
                        echo "Error: ".mysqli_error($mkye);
                      }
                    }
                    else
                    {
                      yellow_card();
                    }
                }
                else
                {
                  yellow_card();
                }
              }
              else if ($gr == "Remove" || $gr == "remove")
              {
                $rn = "SELECT red FROM get_card WHERE user='$name'";
                $rnre = mysqli_query($conn,$rn);
                $rrow = mysqli_fetch_assoc($rnre);

                if($rrow['red'] == 0)
                {
                  echo "Sorry this account have no any red card! so you can't remove it.";
                }
                else
                {
                  $num = $rrow['red']-1;

                  $usrmv = "UPDATE get_card SET red='$num' WHERE user='$name'";

                  if(mysqli_query($conn,$usrmv))
                  {
                    echo "Removed one red card from this account";
                  }
                  else
                  {
                    echo "Error: ".mysqli_error($gr);
                  }
                }
              }
          else
          {
            echo "Please check your Speling!";
          }
        }
      }
      else
      {
        echo "Sorry! This account is not on our database";
      }
  }

  // Yellow Card Function

  function yellow_card()
  {
        //Get user Input
    $username = ($_POST['user']);

        //Include time file
    date_default_timezone_set("Asia/Dhaka");
    $c = strtotime("now");
    $starttime = date("Y:m:d h:i:sa",$c);
    $d = strtotime("+10 minutes");
    $endtime = date("Y:m:d h:i:sa",$d);


        //String to Array
    $textarr = explode(" ",$username,3);
    $name = $textarr[0];
    $gr = $textarr[1];
    $cause = $textarr[2];

        //Database connection
    $host = "localhost";
    $dbuser = "root";
    $pass = "";
    $db = "card";

    $conn = mysqli_connect($host,$dbuser,$pass,$db);

    $yn = "SELECT yellow FROM get_card WHERE user='$name'";
    $ynre = mysqli_query($conn,$yn);
    $yrow = mysqli_fetch_assoc($ynre);

    $num = $yrow['yellow']+1;

    $update = "UPDATE get_card SET yellow = '$num' WHERE user='$name'";
    if(mysqli_query($conn,$update))
      {
        $tup = "UPDATE get_card SET endtime='$endtime' WHERE user='$name'";
        if(mysqli_query($conn,$tup))
        {
          if($num >= 2)
          {
            red_card();
          }
          else
          {
            echo $name." get a yellow card, if he again get another yellow within 10 minutes, he will get a red card.";
          }
        }
        else
        {
          echo "Error!";
        }
      }
    else
      {
        echo "Error!";
      }

    mysqli_close($conn);
  }

  // Red Card Function

  function red_card()
  {
      //Get user Input
    $username = ($_POST['user']);

      //Include time file
    date_default_timezone_set("Asia/Dhaka");
    $c = strtotime("now");
    $starttime = date("Y:m:d h:i:sa",$c);
    $d = strtotime("+10 minutes");
    $endtime = date("Y:m:d h:i:sa",$d);

      //String to Array
    $textarr = explode(" ",$username,3);
    $name = $textarr[0];
    $gr = $textarr[1];
    $cause = $textarr[2];

      //Database connection
    $host = "localhost";
    $dbuser = "root";
    $pass = "";
    $db = "card";

    $conn = mysqli_connect($host,$dbuser,$pass,$db);

    $rn = "SELECT red FROM get_card WHERE user='$name'";
    $rnre = mysqli_query($conn,$rn);
    $rrow = mysqli_fetch_assoc($rnre);

    $num = $rrow['red']+1;


    $redget = "UPDATE get_card SET red = '$num' WHERE user='$name'";
    if(mysqli_query($conn,$redget))
    {
      $upyellow = "UPDATE get_card SET yellow = '0' WHERE user='$name'";
      if(mysqli_query($conn,$upyellow))
        {
          $upend = "UPDATE get_card SET endtime='0000-00-00 00:00:00' WHERE user='$name'";
          if(mysqli_query($conn,$upend))
          {
            echo "This account is get a red card";
          }
          else
          {
            echo "Error: ".mysqli_error($upend);
          }
        }
      else
        {
          echo "Error: ".$upyellow;
        }
    }
    else
      {
        echo "Error: ".$redget;
      }

    mysqli_close($conn);

  }

  if(isset($_POST['submit']))
  {
    cmd();
  }

  ?>


  <form action="" method="post">
    <p>Want to know about users? type: show users</p></br>
    <input type="text" placeholder="Input your text here" name="user">
    <p>Hint: Username Get/Remove Cause</p>
    <button name="submit">Card</button>
  </form>
