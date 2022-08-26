# One Signal Push Notifications Class

## Description
This is a simple class for One Signal Server Side Usage. 
## How To Use?
- First include class file
```php
<?php
    require_once('oneSignal.class.php');
?>
```
- Then call the class
```php
<?php
    require_once('oneSignal.class.php');
    $oneSignal = new oneSignal("YOUR_APP_ID","YOUR_API_KEY");
?>
```
- Lastly call the sendMessage function
```php
<?php
    require_once('oneSignal.class.php');
    $oneSignal = new oneSignal("YOUR_APP_ID","YOUR_API_KEY");
    $response = $oneSignal->sendMessage('Message Title','Message content',['userOneSignalPlayerId1','userOneSignalPlayerId2']);
?>
```
You can browse oneSignalUsage.php for more
# Example Code Block
```php
<?php
    require_once("oneSignal.class.php");

    $APP_ID     = "YOUR_APP_ID";
    $API_KEY    = "YOUR_API_KEY";

    $oneSignal  = new oneSignal($APP_ID,$API_KEY);

    $title      = "Well done 🥳";
    $message    = "You sent your first notification successfully✌🏻";


    $userIdList = ['playerId1','playerId2','...'];

    $response = $oneSignal->sendMessage($title,$message,$userIdList);
    $response = json_decode($response);

    echo'<pre>';
    print_r($response); 
?>
```