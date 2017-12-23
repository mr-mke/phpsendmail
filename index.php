<?php
if(isset($_POST['submit'])){
    if(isset($_POST['to'])){
        $to=$_POST['to'];
        if(isset($_POST['subject'])){
            $subject=$_POST['subject'];
            if(isset($_POST['messagetext'])){
                $messagetext=$_POST['messagetext'];
                $message = "<html><head><title>HTML email</title></head><body><div>$messagetext</div></body></html>";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                if(isset($_POST['from'])){
                    $from=$_POST['from'];
                }else{
                    $from="sender@example.com";
                }
                $headers .= "From: <$from>\r\n";
                if(isset($_POST['cc'])){
                    $cc=$_POST['cc'];
                    $headers .= "Cc: $cc\r\n";
                }
                mail($to,$subject,$message,$headers);

                //Clean up form data
                unset($to);
                unset($cc);
                unset($subject);
                unset($messagetext);
                unset($submit);
                $mescolor="green";
                $mes="Message sent!...";
            }else{
                $mescolor="red";
                $mes="Can not send empty message!...";
            }
        }else{
            $mescolor="red";
            $mes="Must specify subject!...";
        }
    }else{
        $mescolor="red";
        $mes="Can not omit the To field!...";
    }
}
if(!isset($from))
    $from="sender@example.com";
echo "<!DOCTYPE html>";
echo "<html><head></head><body><center>";
echo "<div style='font-size:large;'>Sendmail test form</div><br>";
if(isset($mes))
	echo "<div style='color:$mescolor;'>$mes</div>";
echo "<form method='post'><table>";
echo "<tr><td>From</td><td>:</td><td><input type='text' name='from' value='$from' size='50'></td></tr>";
echo "<tr><td>To</td><td>:</td><td><input type='text' name='to' value='$to' size='50'></td></tr>";
//echo "<tr><td>CC</td><td>:</td><td><input type='text' name='cc' value='$cc' size='50'></td></tr>";
echo "<tr><td>Subject</td><td>:</td><td><input type='text' name='subject' value='$subject' size='50'></td></tr>";
echo "<tr><td valign='top'>Message</td><td valign='top'>:</td><td><textarea name='messagetext' rows='10' cols='50'>$messagetext</textarea></td></tr>";
echo "<tr><td colspan='3' align='center'><br><input type='submit' value='Send' name='submit'></td></tr>";
echo "</table></form></center></body></html>";
?>
