<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./css/global.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<?php
$pa='';
if(isset($_GET['passwd']))
$pa=$_GET['passwd'];
$ripw=file_get_contents("passwd");
if(strcmp($pa."\x20\x0d\x0a",$ripw))
{
    ?>
    
<form method="GET" action="./satori.php">
Password<input name='passwd'/>
<input type="submit"/>

</form>
    <?php
}
else
{
    ?>
    <body>
    <canvas id="myCanvas" height="500" width="500"></canvas>
	<div id="nowround"></div>
	<div id="maxround"></div>
	<div id="cz"></div>
	<div id="mess"></div>
</body>
<script>

		image_wall = new Image()
        image_grass = new Image()
        image_satori = new Image()
        image_koishi = new Image()
        image_wall.src = "./img/wall.png"
        image_grass.src = "./img/grass.png"
        image_satori.src = "./img/satori.png"
        image_koishi.src = "./img/koishi.png"
  /*  const init = function (img1src, img2src, rows) {
        let i = 0
        img1.onload = function () {
            i++
            if (i === 2) {
                start(img1, img2, rows)
            }
        }
        img2.onload = function () {
            i++
            if (i === 2) {
                start(img1, img2, rows)
            }
        }
    }
*/
    const start = function (gg) {
        gg=JSON.parse(gg)
        let canvas = document.getElementById('myCanvas')
        let ctx = canvas.getContext('2d')
        let string = ''
        string=gg[0].map;
        heigh=gg[0].height;
        widt=gg[0].width;
    for (let i = 0; i < widt*heigh; i++) {
        if (string.charAt(i) === '#'){
            ctx.drawImage(image_wall, Math.floor(i % widt) * 32, Math.floor(i / widt) * 32, 32, 32)
		}
        else if (string.charAt(i) === '.'){
            ctx.drawImage(image_grass, Math.floor(i % widt) * 32, Math.floor(i / widt) * 32, 32, 32)
        }
        else if (string.charAt(i) === 'S'){
            ctx.drawImage(image_satori, Math.floor(i % widt) * 32, Math.floor(i / widt) * 32, 32, 32)
        }
        else if (string.charAt(i) === 'K'){
            ctx.drawImage(image_koishi, Math.floor(i % widt) * 32, Math.floor(i / widt) * 32, 32, 32)
        }
    }
}

    let setting = {
        img1src: '',
        img2src: '',
        rows: 16,
    }
    //init(setting.img1src, setting.img2src, setting.rows)




</script>
    <script>
        
function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}
function nextRound()
{
    $.get({url:"humanrunner/satorimap.txt",
    success : function(data)
    {
		console.log(data);
		dataJson=JSON.parse(data);
		$("#nowround").text(dataJson[0].round);
		$("#maxround").text(dataJson[0].maxround);
        start(data);
    },
	error: function (jqXHR, textStatus, errorThrown) 
	{
		$("#mess").text("游戏结束");
	}
	});
    setTimeout("nextRound()", 1000);
}
nextRound();
var choices=[];
choices[48]='W';
choices[49]='S';
choices[50]='A';
choices[51]='D';
choices[52]='STAY';
$("#cz").text("当前操作:STAY");
var currentChoice=52;
window.document.onkeydown = disableRefresh;
function disableRefresh(evt){
	evt = (evt) ? evt : window.event
	if (evt.keyCode) {
		keycode=evt.keyCode
		if(keycode==87) currentChoice=48
		if(keycode==83) currentChoice=49
		if(keycode==65) currentChoice=50
		if(keycode==68) currentChoice=51
		if(keycode==32) currentChoice=52
		if(keycode >= 48 && keycode<=52){
			currentChoice=keycode
		}
		$("#cz").text("当前操作:"+choices[currentChoice]);
		if(keycode==13)
		{
			$.post({url:"submit.php",
			data:{"passwd": GetQueryString("passwd"),"type":"satori","nr":currentChoice-48},success:function(data)
			{
				console.log(data);
				$("#mess").text(data);
			}
			});
		}
     //do something
   }
}
    </script>
    <?php
}
?>

