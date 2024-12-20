<!DOCTYPE html>
<html>
  <head>
    <!--link rel="stylesheet" href="./movieTile.css"-->
    <link rel="stylesheet" href="../globalStyles.css">
  </head>
<body>
<header class="subPageHeader">
  <a target="_self" href="../">
    <div id='returnHome'>
      <p>Home</p>
  </div>
</a>
<a target="_self" href="javascript:history.back()">
  <div id='returnHome'>
    <p>Back</p>
</div></a>
<?php
include("../easyflixheadertitle.svg");

?>
<h1 id="pagetitle"></h1>
</header>
<section>
  <div id="response"></div>
  <script type="text/javascript">
    let hrfString = window.location.href.toString();
    let url = new URL(hrfString);
    let movieIdParam = url.searchParams.get("movieId");
    let nameParam = url.searchParams.get("name");
    const divElement = document.getElementById("response");

    const options = {
      method: 'GET',
      headers: {
        accept: 'application/json',
        Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNzQzYWQ4NWM1MTU1NmUzZDgyMDliYzkwMWVlNzY0NiIsIm5iZiI6MTczMzc0NTkxNy40OTQwMDAyLCJzdWIiOiI2NzU2ZGNmZDZlMGJlZDI2NmI3ZmFiM2QiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.3eEChcFzcTubHssYx6QAOY3yIJlmisJQWH3ynQS7uEA'
      }
    };

    function getMovieTrailer(arg)
    {
      let id = arg;

      fetch('https://api.themoviedb.org/3/movie/'+id+'/videos?language=en-US', options)
      .then(res => res.json())
      .then(res => {
        ;
        for(const x in res)
        {
          var mov;
          if(Array.isArray(res[x]))
            {
              mov = res[x][0];
            }
            else
            {
              mov = res[x].key;
            }
            console.log(mov);
        }
        const l_videoplayer = document.getElementById("TrailerFrame");
        document.documentElement.style.overflowX="hidden";
        let aspectratio = (1080/1920);
        l_videoplayer.setAttribute("height",(window.innerWidth -32)*aspectratio);
        l_videoplayer.setAttribute("width",(window.innerWidth -32));
        //dwindow.addEventListener("resize", (event) => {});
        window.onresize = ()=> {l_videoplayer.setAttribute("height",((window.innerWidth -32)*aspectratio));
        l_videoplayer.setAttribute("width",window.innerWidth);}
        l_videoplayer.setAttribute("title",mov.name);
        l_videoplayer.setAttribute("referrerpolicy","strict-origin-when-cross-origin");
        l_videoplayer.setAttribute("frameborder",0);
        l_videoplayer.setAttribute("allow","accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen;");
        l_videoplayer.setAttribute("id","videoplayer");
        l_videoplayer.setAttribute("mozallowfullscreen","mozallowfullscreen");
        l_videoplayer.setAttribute("msallowfullscreen","msallowfullscreen");
        l_videoplayer.setAttribute("oallowfullscreen","oallowfullscreen");
        l_videoplayer.setAttribute("webkitallowfullscreen","webkitallowfullscreen");
        l_videoplayer.setAttribute("src","https://www.youtube.com/embed/"+mov.key);

        //l_videoplayer.setAttribute("allowfullscreen","allowfullscreen");
      })
      .catch(err => console.log(err));

    }


    function getMovieData(arg)
    {
      let id = arg;


    fetch('https://api.themoviedb.org/3/movie/'+id+'?language=en-US', options)
    .then(res => res.json())
    .then(res => { console.log(res);
      const l_divElement = document.getElementById("response");
      const l_videoplayer = document.createElement("iframe");
      l_divElement.appendChild(l_videoplayer);
      l_videoplayer.id="TrailerFrame";
      getMovieTrailer(id);


    })
    .catch(err => console.log(err));
    //callback here maybe, since we can append to the fetch for this one this, might be usefull. document.DOM.
    }
    getMovieData(movieIdParam);
    const videoplayer = document.getElementById("TrailerFrame");
    document.getElementById("pagetitle").style.whiteSpace="pre";
    document.getElementById("pagetitle").textContent = "EasyFlix/Movie\t\uD83C\uDF9E"+nameParam;

  </script>
<!--iframe width="1280" height="720" src="https://www.youtube.com/embed/rxPRhy276ls" title="Official Trailer - MY LIFE WITHOUT ME (2003, Sarah Polley, Scott Speedman)" ></iframe-->

</section>
<section>
<div style="width:500px; height: 1000px; backdrop-filter: blur(6px);">

</div>
</section>
<style>
  body, body>*{
    backdrop-filter: blur(6px);
    /* height: -webkit-fill-available; */
    width: 100vw;
    heith: 100vh;
    }
    html{
      width: 100vw;
      heith: 100vh;
      background-image: url('https://media.istockphoto.com/id/1494642262/photo/people-in-the-cinema-auditorium-with-empty-white-screen.jpg?s=612x612&w=0&k=20&c=wiVYHafqEAlvufaCpOTZhn9wuklrgKHdDHWqpmMGhjw=');
    }
</style>

</body>

</html>
