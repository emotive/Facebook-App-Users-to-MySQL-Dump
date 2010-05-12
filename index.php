<?php

// Get these from http://developers.facebook.com
$api_key = '760a4621e7ceccc1672ada5326b06944';
$secret  = '74f7839cc41955fe941ff61624d83800';

require_once 'facebook.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();

$user_details = $facebook->api_client->users_getInfo($user, "email");

if (!is_array($user_details)) {
 $data["email"] = '';
}
 else {
 $emails = $data["email"] = $user_details[0]["email"];
}

$mysqli = mysqli_connect ("db2411.perfora.net", "dbo329156018", "central2516", "db329156018");
$sql = "INSERT INTO emails (email_address) VALUES ('$emails')";
$res = mysqli_query($mysqli, $sql);

mysqli_close($mysqli);

$message = 'is supporting the Ghana Black Stars in the 2010 World Cup. You can join me in supporting the Ghana Black Stars on Facebook at http://apps.facebook.com/ghanablackstars.';
$facebook->api_client->stream_publish($message);

$subject = 'Thank You';
$text = '<p><fb:name uid="'.$user.'" firstnameonly="true" shownetwork="false" useyou="false" linked="false" />,</p><p>Thank you for installing the Ghana Black Stars Facebook application and showing your support for the Ghana Black Stars. This is the first ever World Cup in Africa and Ghana and the rest of Africa is going to shine. Help us blanket Facebook with this application by clicking on this link and inviting all your friends and family to come and support the Ghana Black Stars. Click this link http://jqparties.com/ghanablackstars/invite.php to send invitations to your friends asking them to join in supporting the Ghana Black Stars.</p><p>Thank You</p>';

$invitees = $facebook->api_client->friends_get();
$invitees = array_slice($invitees, 0, 48);

$result = $facebook->api_client->notifications_sendEmail($user, $subject, NULL, $text);

?>

<fb:title>Thank You - Ghana Black Stars on Facebook</fb:title>
<link rel="stylesheet" type="text/css" href="http://jqparties.com/css/blackstars26.css">
<div id="container">
  <div class="logo"><a title="Ghana Black Stars" href="index.php"><img src="http://jqparties.com/ghanablackstars/images/logo.jpg" alt="Ghana Black Stars" title="Ghana Black Stars" width="60" height="60" border="0"></a></div>
  <div class="navbar">
    <ul class="nav">
      <li><a title="Home" href="index.php">Home</a></li>
      <li><a title="Videos" href="videos.php">Videos</a></li>
      <li><a title="Invite Friends" href="invite.php">Invite Your Friends</a></li>
      <li><a title="News" href="news.php">News</a></li>
      <li><a title="Forum" href="comments.php">Forum</a></li>
      <li><a title="About the Black Stars" href="about.php">About the Black Stars</a></li>
      <li><a style="border:none;" title="jQparties.com" href="http://jqparties.com/">Brought to you By jQParties.com</a></li>
    </ul>
  </div>
  <div id="left">
    <div class="profilepic">
      <fb:profile-pic uid="<?php echo $user; ?>" linked="true" size="normal" />
    </div>
    <div class="menubox" style="margin-top:10px; margin-bottom:10px;">
      <div class="menuitem"><img src="http://jqparties.com/facebook/images/friends.png" title="Invite friends" alt="Invite friends" border="0" align="middle" /> <a href="invite.php">+Invite friends</a></div>
      <div class="menuitem" style="border:none;"><img src="http://jqparties.com/facebook/images/videos.png" title="Watch Videos" alt="Watch videos" border="0" align="middle" /> <a href="videos.php">+Watch videos</a></div>
    </div>
    <div class="sharebutton">
      <fb:share_button class="meta">
        <meta name="medium" content="news"/>
        <link rel="target_url" href="http://apps.facebook.com/ghanablackstars"/>
        <meta name="title" content="I support the Ghana Black Stars in the 2010 World Cup. Become a fan today." />
        <meta name="description" content="Show your support for the Ghana Black Stars get the badge today." />
        <link rel="image_src" href="http://jqparties.com/ghanablackstars/images/blackstars2.jpg" / >
      </fb:share_button>
    </div>
  </div>
  <!-- left -->
  <div id="right">
    <h1>Thank You <fb:name uid="<?php echo $user; ?>" firstnameonly="true" shownetwork="false" useyou="false" linked="false" />! Invite Your Friends</h1>
    <p>Click here to <a href="invite.php">send invitations</a> asking them to support the Black Stars!</p>
    <p>
      <?php 
foreach ($invitees as $invitees) {
echo "<fb:profile-pic uid=\"".$invitees."\" size=\"thumb\" width=\"32\" height=\"32\" linked=\"false\" />";
}
?>
    </p>
    <p>Click here to <a href="invite.php">send invitations</a> asking them to support the Black Stars!</p>
    <table width="100%" cellpadding="5" cellspacing="0" border="0">
      <tr>
        <td width="50%" valign="top"><p><a href="invite.php"><img src="http://jqparties.com/ghanablackstars/images/blackstars3.jpg" width="200" height="133" alt="Invite your friends and family" title="Invite your friends and family" border="0" /></a></p>
          <fb:if-section-not-added section="profile">
            <fb:name uid="<?php echo $user; ?>" firstnameonly="true" shownetwork="false" useyou="false" linked="false" />, add the Black Stars badge to your profile page.<fb:add-section-button section="profile" />
          </fb:if-section-not-added></td>
      </tr>
    </table>
  </div>
  <!-- right -->
  <fb:google-analytics uacct="UA-1056449-15" />
  <!-- Paste this code just above the closing </body> of your conversion page. The tag will record a conversion every time this page is loaded. Optional 'sku' and 'value' fields are described in the Help Center. -->
  <script src="//ah8.facebook.com/js/conversions/tracking.js"></script>
  <script type="text/javascript">
try {
  FB.Insights.impression({
     'id' : 6002455460222,
     'h' : 'cc632e9e0b',
     'value' : 0.01 // you can change this dynamically
  });
} catch (e) {}
</script>
</div>
