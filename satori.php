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
    <canvas id="myCanvas" height="500" width="500"></canvas><div id="mess"></div>
</body>
<script>

img1 = new Image()
        img2 = new Image()
        img3 = new Image()
        img4 = new Image()
        img1.src = "./img/wall.png"
        img2.src = "./img/grass.png"
        img3.src = "./img/s.png"
        img4.src = "./img/t.png"
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
        let string = ''/*
        for (let i = 0; i < rows * rows; i++) {
            string += Math.random() > 0.495 ? '#' : '.'
        }*///console.log(gg[0].map);
        string=gg[0].map;
        heigh=gg[0].height;
        widt=gg[0].width;
        for (let i = 0; i < widt*heigh; i++) {
            if (string.charAt(i) === '#')
                ctx.drawImage(img1, Math.floor(i % widt) * 32, Math.floor(i / heigh) * 32, 32, 32)
            else if (string.charAt(i) === '.'){
                ctx.drawImage(img2, Math.floor(i % widt) * 32, Math.floor(i / heigh) * 32, 32, 32)
            }
            else if (string.charAt(i) === 'S'){
                ctx.drawImage(img3, Math.floor(i % widt) * 32, Math.floor(i / heigh) * 32, 32, 32)
            }
            else if (string.charAt(i) === 'T'){
                ctx.drawImage(img4, Math.floor(i % widt) * 32, Math.floor(i / heigh) * 32, 32, 32)
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
    function fuck()
    {
        $.get({url:"humanrunner/satorimap.txt",
        success : function(data)
        {
console.log(data);
        start(data);
        }});
        setTimeout("fuck()", 1000);
    }
    fuck();
    window.document.onkeydown = disableRefresh;
function disableRefresh(evt){
evt = (evt) ? evt : window.event
if (evt.keyCode) {
   if(evt.keyCode >= 48 && evt.keyCode<=52){
    $.post({url:"submit.php",
    data:{"passwd": GetQueryString("passwd"),"type":"satori","nr":evt.keyCode-48},success:function(data)
    {
        console.log(data);
        $("#mess").text(data);
    }
});
     //do something
   }
}
}
    </script>
    <?php
}
?>

