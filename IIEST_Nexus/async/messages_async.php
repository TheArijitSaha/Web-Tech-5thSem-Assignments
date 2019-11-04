<?php
    // PHP File for asynchronous requests of skills, if logged in.

    require_once('../classes/DataBase.php');
    require_once('../classes/LoginClass.php');
    require_once('../classes/User.php');
    require_once('../classes/variables.php');

    $logged_in_id = LoginClass::isLoggedIn();

    if (! $logged_in_id)
    {
        // Someone is trying to access this php file and inspect its content
        // through direct URL.
        header("Location: index.php");
        exit();
    }

    $current_user = new User($logged_in_id);

    function messageSort($a,$b){
        if ($a[sent_at]==$b[sent_at])
            return 0;
        return ($a[sent_at]<$b[sent_at])?1:-1;
    }


    // To get JSON of Chat Users:
    if(isset($_POST['showChatUsers'])){
        $messages;

        $result = DataBase::query('SELECT mid, m1.sender AS chateeid, sent_at, name AS chateename, profilepic, seen'.
                                  ' FROM '.DataBase::$message_table_name.' AS m1'.
                                    ' INNER JOIN'.
                                  ' '.DataBase::$user_table_name.' AS u1'.
                                  ' ON m1.sender = u1.id'.
                                    ' INNER JOIN'.
                                  ' ('.
                                    ' SELECT sender, MAX(sent_at) maxTime'.
                                    ' FROM '.DataBase::$message_table_name.
                                    ' WHERE receiver = :thisuser'.
                                        ' GROUP BY sender'.
                                    ' ) AS m2'.
                                    ' ON m1.sender = m2.sender'.
                                        ' AND sent_at = maxTime',
                                    array(":thisuser"=>$current_user->getID())
                                );

        if ($result['executed']===false)
        {
            echo "ERROR: Not able to execute SQL<br>";
            print_r($result['errorInfo']);
            exit();
        }
        $messages[received]=$result[data];

        $result = DataBase::query('SELECT mid, m1.receiver AS chateeid, sent_at, name AS chateename, profilepic, seen'.
                                  ' FROM '.DataBase::$message_table_name.' AS m1'.
                                    ' INNER JOIN'.
                                  ' '.DataBase::$user_table_name.' AS u1'.
                                  ' ON m1.receiver = u1.id'.
                                    ' INNER JOIN'.
                                  ' ('.
                                    ' SELECT receiver, MAX(sent_at) maxTime'.
                                    ' FROM '.DataBase::$message_table_name.
                                    ' WHERE sender = :thisuser'.
                                        ' GROUP BY receiver'.
                                    ' ) AS m2'.
                                    ' ON m1.receiver = m2.receiver'.
                                        ' AND sent_at = maxTime',
                                    array(":thisuser"=>$current_user->getID())
                                );

        if ($result['executed']===false)
        {
            echo "ERROR: Not able to execute SQL<br>";
            print_r($result['errorInfo']);
            exit();
        }
        $messages[sent]=$result[data];

        $latest_messages;
        foreach ($messages[sent] as $key => $value) {
            if(array_key_exists($value[chateeid],$latest_messages)){
                if($latest_messages[$value[chateeid]][sent_at]<$value[sent_at]){
                    $latest_messages[$value[chateeid]]=$value;
                    $latest_messages[$value[chateeid]][seen]=1;
                }
            }
            else{
                $latest_messages[$value[chateeid]]=$value;
                $latest_messages[$value[chateeid]][seen]=1;
            }
        }
        foreach ($messages[received] as $key => $value) {
            if(array_key_exists($value[chateeid],$latest_messages)){
                if($latest_messages[$value[chateeid]][sent_at]<$value[sent_at]){
                    $latest_messages[$value[chateeid]]=$value;
                }
            }
            else{
                $latest_messages[$value[chateeid]]=$value;
            }
        }

        $final_list=array();
        foreach ($latest_messages as $key => $value){
            array_push($final_list,$value);
        }
        usort($final_list,'messageSort');
        echo json_encode($final_list);
    }


    // To get JSON of a single Chat:
    if(isset($_POST['showConversation'])){
        $id=$_POST['showConversation'];
        $result = DataBase::query('SELECT *'.
                                  ' FROM '.DataBase::$message_table_name.
                                  ' WHERE (receiver=:me AND sender=:id)'.
                                    ' OR (receiver=:id AND sender=:me)',
                                  array(":id"=>$id,":me"=>$current_user->getID())
                                );

        if ($result['executed']===false)
        {
            echo "ERROR: Not able to execute SQL<br>";
            print_r($result['errorInfo']);
            exit();
        }
        echo json_encode($result[data]);
    }

    // To send a message
    if(isset($_POST['sendMessage'])){
        $id=$_POST['sendMessage'];
        $result = DataBase::query('INSERT INTO '.DataBase::$message_table_name.
                                  ' VALUES ( DEFAULT, :from, :to, NOW(), :body, FALSE)',
                                  array(":to"=>$id,
                                        ":from"=>$current_user->getID(),
                                        ":body"=>$_POST[body]
                                    )
                                );

        if ($result['executed']===false)
        {
            echo "ERROR: Not able to execute SQL<br>";
            print_r($result['errorInfo']);
            exit();
        }

        $result = DataBase::query('SELECT * FROM '.DataBase::$message_table_name.
                                  ' WHERE mid=:lastID',
                                  array(":lastID"=>$result[lastID])
                              );

        if ($result['executed']===false)
        {
            echo "ERROR: Not able to execute SQL<br>";
            print_r($result['errorInfo']);
            exit();
        }

        echo json_encode($result[data]);
    }

    // To make a conversation Seen:
    if(isset($_POST['seenConversation'])){
        $id=$_POST['seenConversation'];
        $result = DataBase::query('UPDATE '.DataBase::$message_table_name.
                                  ' SET seen=TRUE'.
                                  ' WHERE seen=FALSE'.
                                    ' AND receiver=:me'.
                                    ' AND sender=:id',
                                  array(":id"=>$id,":me"=>$current_user->getID())
                                );

        if ($result['executed']===false)
        {
            echo "ERROR: Not able to execute SQL<br>";
            print_r($result['errorInfo']);
            exit();
        }
    }

?>
