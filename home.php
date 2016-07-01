<?php

// Calling Cards Function

function call()
{
      //Get user Input
  $username = ($_POST['user']);
  $one = 1;

      //Include time file
  include 'time.php';

      //String to Array
  $textarr = explode("-",$username);
  $name = $textarr[0];
  $gr = $textarr[1];
  $gor = $textarr[2];
  $cause = $textarr[3];

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
            if($gor == "Yellow" || $gor == "yellow")                        //Give Yellow Card
            {
              $chyellow = "SELECT yellow FROM get_card WHERE user='$name'";
              $reyellow = mysqli_query($conn,$chyellow);

              $row = mysqli_fetch_assoc($reyellow);

              if($time <= $endtime)
              {
                if($row['yellow'] == $one)
                  {
                    red_card();
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
              else
              {
                red_card();                                                  //Give Red Card
              }
            }
            else if ($gr == "Remove" || $gr == "remove")
            {
              if($gor == "Red" || $gor == "red")                            //Remove Red Card
              {
                $rn = "SELECT red FROM get_card WHERE user='$name'";
                $rnre = mysqli_query($conn,$rn);
                $rrow = mysqli_fetch_assoc($rnre);

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
              else
              {
                $yn = "SELECT yellow FROM get_card WHERE user='$name'";     //Remove Yellow Card
                $ynre = mysqli_query($conn,$rn);
                $yrow = mysqli_fetch_assoc($ynre);

                $num = $yrow['yellow']-1;

                $usrmv = "UPDATE get_card SET yellow='$num' WHERE user='$name'";

                if(mysqli_query($conn,$usrmv))
                {
                  echo "Removed one yellow card from this account";
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
  include 'time.php';

      //String to Array
  $textarr = explode("-",$username);
  $name = $textarr[0];
  $gr = $textarr[1];
  $gor = $textarr[2];
  $cause = $textarr[3];

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
      if($num >= 2)
        {
          red_card();
        }
      else
        {
          echo $name." get a yellow card";
        }
    }
  else
    {
      echo "Error: ".$mysqli_error($conn);
    }

  mysqli_close($conn);
}

// Red Card Function

function red_card()
{
    //Get user Input
  $username = ($_POST['user']);

    //Include time file
  include 'time.php';

    //String to Array
  $textarr = explode("-",$username);
  $name = $textarr[0];
  $gr = $textarr[1];
  $gor = $textarr[2];
  $cause = $textarr[3];

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
    $upyellow = "UPDATE get_card SET yellow = '0' Where user='$name'";
    if(mysqli_query($conn,$upyellow))
      {
        echo "This account is get a red card";
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
  call();
}

?>


<form action="" method="post">
  <p>Hint: Username-Get/Remove-Yellow/Red-Cause</p>
  <input type="text" placeholder="Input your text here" name="user">
  <button name="submit">Card</button>
</form>
