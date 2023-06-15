<?php

/**

@Author: dstjohn (Mediacast1/Casterclub)
@Date started: 05-03-2002 (10:00A.M)
@Date Ended: 05-03-2002 (6:03 P.M)
@Date Updated: 05-03-2002 (6:06 P.M) Almost forgot, nothing like a 20 year pull request in the making.
@Requirements:
1.SHOUTcast streaming server
2.Oddcast dsp with winamp/xmms (recomended setup)
3.Webserver with php 4.x (Recommended environment: Unix (Freebsd, Red Hat etc.. with Apache 3.x)
@Support: None, post in the casterclub forums
@Core script Information:
SHOUTcast Song Status was written and developed on Windows Xp with apache and php4.1.2
Has not been tested on IIs webservers, if you do so and get it to work please let us know
At the forums (http://casterclub.com/forums)
Also has been tested on freebsd with apache, php4.1.2 and works fine.
*/

//connect to shoutcast server
include('./config.php');  //you may edit this path to fit your server environment otherwise leave it alone
$scfp = fsockopen("$scip", $scport, &$errno, &$errstr, 30);
 if(!$scfp) {
  $scsuccs=1;
echo''.$scdef.' is Offline';
 }
if($scsuccs!=1){

  //for newer shoutcast servers
fputs ($scfp, "GET /admin.cgi?mode=viewxml HTTP/1.1\r\nHost: $scip:$scport\r\n .
User-Agent: SHOUTcast Song (author: dstjohn@mediacast1.com)(Mozilla Compatible)\r\n .
Authorization: Basic ".base64_encode ("admin:$scpass")."\r\n\r\n");
 while(!feof($scfp)) {
  $page .= fgets($scfp, 1000);
 }

//define  xml elements
 $loop = array("STREAMSTATUS", "BITRATE");
 $y=0;
 while($loop[$y]!=''){
  $pageed = ereg_replace(".*<$loop[$y]>", "", $page);
  $scphp = strtolower($loop[$y]);
  $$scphp = ereg_replace("</$loop[$y]>.*", "", $pageed);
  if($loop[$y]==SERVERGENRE || $loop[$y]==SERVERTITLE || $loop[$y]==SONGTITLE)
   $$scphp = urldecode($$scphp);

// uncomment the next line to see all variables
// echo'$'.$scphp.' = '.$$scphp.'<br>';
  $y++;
 }
//end intro xml elements

//get song info and history
 $pageed = ereg_replace(".*<SONGHISTORY>", "", $page);
 $pageed = ereg_replace("</SONGHISTORY>.*", "", $pageed);
 $songatime = explode("<SONG>", $pageed);
 $r=1;
 while($songatime[$r]!=""){
  $t=$r-1;
  $playedat[$t] = ereg_replace(".*<PLAYEDAT>", "", $songatime[$r]);
  $playedat[$t] = ereg_replace("</PLAYEDAT>.*", "", $playedat[$t]);
  $song[$t] = ereg_replace(".*<TITLE>", "", $songatime[$r]);
  $song[$t] = ereg_replace("</TITLE>.*", "", $song[$t]);
  $song[$t] = urldecode($song[$t]);


//format the date
$frmt_date[$t] = date('l dS of F Y h:i:s A',$playedat[$t]);
	
//you may edit the html below, make sure to keep variables intact
echo'
<b>'.$t.'.</b>Song:  '.$song[$t].' - <b>Played @</b> '.$frmt_date[$t].'<BR>
';


		$r++;
	}

fclose($scfp);
}
?>
