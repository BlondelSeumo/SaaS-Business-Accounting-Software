

<?php header("Content-type: text/css; charset: UTF-8"); ?>


<?php echo $site_font = $_GET['font']; ?>

html {
	font-family: '<?=$site_font?>', sans-serif;
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
}

body {
	position: relative;
	margin: 0;
	padding: 0;
	font-family: '<?=$site_font?>', sans-serif;
	font-size: 13px;
	background: #fff;
	color: #444;
	line-height: 1.8em;
	overflow-x: hidden;
}

h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {
	font-family: '<?=$site_font?>', sans-serif;
	font-weight: 400;
	line-height: 1.8em;
	color: #585858;
	letter-spacing: 0.5px;
	margin-top: 20px;
	margin-bottom: 10px;
}

code, kbd, pre, samp {
	font-family: '<?=$site_font?>', sans-serif;
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	-ms-border-radius: 0;
	-o-border-radius: 0;
	border-radius: 0;
}


.menu-list, .sub-menu {
	position: relative;
	padding: 0;
	margin: 0;
	list-style: none;
	font-family: '<?=$site_font?>', sans-serif;
	text-transform: uppercase;
	color: #222222;
	font-weight: 700;
	letter-spacing: 1px;
}

.read-more a {
	font-family: 'Varela Round', sans-serif;
	font-weight: 900;
}


#comments .comment-author {
	margin-top: 0;
	margin-bottom: 0;
	font-family: 'Varela Round', sans-serif;
	font-size: 16px;
	line-height: normal;
	text-transform: uppercase;
	letter-spacing: 1px;
	color: #000000;
}

.nav-links > div {
	color: #000;
	background-color: #f5f5f5;
	font-size: 10px;
	font-family: 'Varela Round', sans-serif;
	padding: 0 10px;
	margin-bottom: 10px;
	display: inline-block;
	text-transform: uppercase;
	line-height: 2.5em;

}
.widget-title, .widget .title {
    position: relative;
    display: block;
    font-weight: 700;
    font-family: '<?=$site_font?>', sans-serif;
    font-size: 18px;
    margin-top: 0px;
    color: #333;
    padding: 10px 0px;
    border-bottom: 1px solid #ddd;
    margin-bottom: -3px;
    text-align: left;
}

.custom-btn-big {
    font-family: '<?=$site_font?>', sans-serif;
}



.ntp-button {
    position: relative;
    display: inline-block;
    font-size: 12px;
    font-family: '<?=$site_font?>', sans-serif;
    text-transform: uppercase;
    background-color: #f97339;
    padding: 5px 25px;
    line-height: 28px;
    color: #ffffff;
    letter-spacing: 1px;
    border-radius: 5px;
    margin-bottom: 5px;
}
.widget-list h3 {
    letter-spacing: 0;
    line-height: 1.4em;
    font-family: '<?=$site_font?>', sans-serif;
}

.ntp-about .title {
    display: block;
    text-transform: uppercase;
    font-family: "<?=$site_font?>", sans-serif;
    border: none;
    margin-bottom: 0;
}

.wid-cat {
    position: absolute;
    left: 13px;
    top: 13px;
    color: #ffffff;
    padding: 0px 12px 0px;
    font-family: "<?=$site_font?>", sans-serif;
    border-radius: 25px;
    font-size: 12px;
    line-height: 20px;
}