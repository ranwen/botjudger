<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="./css/global.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <body>
    <canvas id="myCanvas" height="500" width="500"></canvas>
	<div id="nowround"></div>
	<div id="maxround"></div>
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
function nextRound()
{
    $.get({url:"humanrunner/koishimap.txt",
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
    </script>