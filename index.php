<?php 

	$articles = new DOMDocument();
 	$articles->load("https://blog.truthforlife.org/rss.xml");

 	$podcast = new DOMDocument();
 	$podcast->load("https://rss.sermonaudio.com/rss_source.rss?filter=mp3");

 	$daily = new DOMDocument();
 	$daily->load("https://rss.sermonaudio.com/rss_special.rss?type=daily");

 	$votd = new DOMDocument();
 	$votd->load("http://labs.bible.org/api/?passage=votd&type=xml");

 	$content = $articles->getElementsByTagName("item");
 	$devotion = $daily->getElementsByTagName("item");
 	$audio = $podcast->getElementsByTagName("item");
 	$verse = $votd->getElementsByTagName("item");

?>
<html>
    <head>
        <title>Your Daily Bread</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">    
    </head>
    <body>
        <div class = "titleBox"></div>
        <div class = "middleLeftBox">
            <ul>
            <?php
            $count = 0;
            // display results based on json names 
            foreach($content as $value){
				$title = $value->getElementsByTagName("title")->item(0)->nodeValue;
				$link = $value->getElementsByTagName("link")->item(0)->nodeValue;
            	$description = $value->getElementsByTagName("description")->item(0)->nodeValue;
		    
            ?>
            <div class="article">
                <a href="<?php echo $link;?>"><h2 class="header"><?php echo $title;?></h2></a>
				<h3><?php echo $description;?></h3>
            </div>
            <br>
            <?php
                $count++;
                if($count == 10) //limit output to 10
                    break;
            }
            ?>
            </ul>
        </div>
        <div class = "middleRightBox">
            <div class = "VoTD">
            <?php 
            	foreach ($verse as $value){
            	$bookname = $value->getElementsByTagName("bookname")->item(0)->nodeValue;
            	$chapter = $value->getElementsByTagName("chapter")->item(0)->nodeValue;
            	$verse = $value->getElementsByTagName("verse")->item(0)->nodeValue;
            	$text = $value->getElementsByTagName("text")->item(0)->nodeValue;
            ?>
            <br>
            <b style = "font-size: 20px; font-family: SafiarSignature;">Verse of the Day</b>
            <br><br>
            <b><?php echo $bookname." ".$chapter.":".$verse;?></b><br>
            <?php echo $text;
            }
        	;?>
            </div>
            <br>
            <div class = "Sermons">
            <b style = "font-size: 20px; font-family: SafiarSignature;">Sermons</b>
            <br><br>
                    <?php 
                        $count1 = 0;
                        foreach ($audio as $value){
                        $file = $value->getElementsByTagName("link")->item(0)->nodeValue;
                        $title = $value->getElementsByTagName("title")->item(0)->nodeValue;
                    ?>
                    <a href="<?php echo $file;?>"><b><?php echo $title;?> </b></a>
                    <br>
                    <?php 
                        $count1++;
                        if($count1 == 10) //limit output to 10
                            break;
                    }
                    ;?>		
        	<a href="http://thebiblestudypodcast.com/"><h4> Click here for more. </h4></a>
            </div>
            <br>
            <div class = "DailyDevotion">
            <b style = "font-size: 20px; font-family: SafiarSignature;">Daily Devotion</b>
            <br><br>
                    <?php 
                        $count2 = 0;
                        foreach ($devotion as $value){
                        $link = $value->getElementsByTagName("link")->item(0)->nodeValue;
                        $title = $value->getElementsByTagName("title")->item(0)->nodeValue;
                    ?>
                    <a href="<?php echo $link;?>"><b><?php echo $title;?></b></a><br>
                    <?php 
                        $count2++;
                        if($count2 == 7) //limit output to 10
                            break;
                    }
                    ;?>
            </div>
        </div>
    </body>
</html>
