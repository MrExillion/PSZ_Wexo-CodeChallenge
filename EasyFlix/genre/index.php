

<!DOCTYPE html>
<html>
  <head Access-Control-Allow-Origin="*">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./movieTile.css">
    <link rel="stylesheet" href="../globalStyles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js" crossorigin="anonymous"></script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" crossorigin="anonymous">
</script>

<?php
//header('Access-Control-Allow-Origin: http://localhost:3000');
//header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, PATCH, DELETE');
//header('Access-Control-Allow-Headers: Content-Type');
//$headers = getallheaders();
//echo $headers['Authorization'];
?>
  </head>
<body>
<header class="subPageHeader">
  <a target="_self" href="../">
    <div id='returnHome'>
      <p>Home</p>
  </div>
</a>
<h1 id="pagetitle"></h1>
</header>
<section>

    <div id="response"></div>
    <script type="text/javascript" crossorigin="Anonymous">
    const options = {
      method: 'GET',
      headers: {
        accept: 'application/json',
        Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNzQzYWQ4NWM1MTU1NmUzZDgyMDliYzkwMWVlNzY0NiIsIm5iZiI6MTczMzc0NTkxNy40OTQwMDAyLCJzdWIiOiI2NzU2ZGNmZDZlMGJlZDI2NmI3ZmFiM2QiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.3eEChcFzcTubHssYx6QAOY3yIJlmisJQWH3ynQS7uEA'
      }
    };
    const fetchCompletionCallback = new Event("fetchcompletion",{"bubbles":true,"cancelable":false});


    let hrfString = window.location.href.toString();
    let url = new URL(hrfString);
    let genreParam = url.searchParams.get("genre");
    let nameParam = url.searchParams.get("name");
    const divElement = document.getElementById("response");
    const eventRendered = new Event("renderComplete",{"bubbles":true,"cancelable":false});
    function startRender(){
      //Rendering start
      requestAnimationFrame(dispatch);
    }
    async function waitForRender(){
      requestAnimationFrame(startRender);
    }
    function dispatch(){
      window.dispatchEvent(eventRendered)
    }

    divElement.setAttribute("class","background");
    var pages;
    var loadedPages;
    function sleep(milliseconds) {
      const date = Date.now();
      let currentDate = null;
      do {
        currentDate = Date.now();
      } while (currentDate - date < milliseconds);
    }
    function movieDetailsPage(arg,arg2) //need this to be a predifined function with arguments, to avoid all the button's targeting the latest processed genre acquired from a fetch.
    {
      let value = arg;
      let value2 = arg2;
      window.location.href="../movie/?movieId="+value+"&name="+value2; // could use both cookies and params, but i think it's a bit simpler to use params in terms of transparency.
    }
    fetch('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc&with_genres='+genreParam, options)
    .then(res => res.json())
    .then(res => {
      pages = res.total_pages;
      console.log(res.total_pages);
    console.log(pages);
    for(let i=1;i<=10;i++)
    {


       fetch('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page='+i+'&sort_by=popularity.desc&with_genres='+genreParam, options)
      .then(res2 => res2.json())
      .then(res2 => {
        let poster_path;
        let poster_path_arr = [];
        let movieTitle_arr = [];
        let movie_title;

        for (const xx in res2) {

          for (const yy in res2[xx]) {

            poster_path_arr[poster_path_arr.length] = res2[xx][yy].poster_path;
            movieTitle_arr[movieTitle_arr.length] = res2[xx][yy].title;
            //console.log(res2[xx][yy].title);
            const newNode = document.createElement("div");
            divElement.appendChild(newNode);
            newNode.setAttribute("class","movieTile");
            // newNode.setAttribute("class","movieTile, image-container");
            newNode.id = "Movie_P"+i+"_N"+yy;
            newNode.style.size="750px 500px";
            //newNode.style.background="darkred";

            const movieCover = document.createElement("img");
            newNode.appendChild(movieCover);
            movieCover.crossOrigin="anonymous";
            movieCover.setAttribute("class","movieCoverClass");
            movieCover.style.size="100% 100%";
            movieCover.style.size="100px 100px";
            //movieCover.src = "https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path;
        //    fetch("https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path,  {credentials: "omit"})
        //   .then(res3 => {console.log(res3); })
          // .then(res3 => {})
          // .catch(err3=> console.log(err3));
            //movieCover.src = "https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path+"?token="+options.headers.Authorization.split("Bearer ");

              movieCover.alt = "image";
              movieCover.src = "https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path;



            const movieTitle = document.createElement("h1");
            newNode.appendChild(movieTitle);
            movieTitle.textContent=res2[xx][yy].title;

            const moviePageBtn = document.createElement("button");
            newNode.appendChild(moviePageBtn);
            moviePageBtn.innerHTML="See More";
            moviePageBtn.id="MoviePageBtn_"+res2[xx][yy].title;
            moviePageBtn.style.display="block";
            moviePageBtn.style.width="40%";
            moviePageBtn.style.translate="80% -50%";
            moviePageBtn.style.background="#FF444444";
            moviePageBtn.style.borderRadius="8px";
            moviePageBtn.style.fontFamily="Work Sans";
            moviePageBtn.setAttribute("argument",res2[xx][yy].id);
            moviePageBtn.setAttribute("argument2",res2[xx][yy].title);
            moviePageBtn.onclick = function(self){ movieDetailsPage(moviePageBtn.getAttribute("argument"),moviePageBtn.getAttribute("argument2")); }
            moviePageBtn.style.fontSize="150%";
            moviePageBtn.style.color="white";


          //_.defer(function() {
           //alert('This is the deferred function');
           //console.log("This is the deferred function");
          //window.addEventListener("load",async function(){
          //window.onload = function(){
          //console.log("onload");
          async function Integrationliketest(timelimitinms,image){
          let ColorIsSet = false;
          const date = Date.now();
          let currentDate = null;
          let maxattempts = 20;
          // initialize colorThief
          let colorThief = new ColorThief();
          let color;
          while(!ColorIsSet)
          {
            if(maxattempts==0){break;}
            maxattempts--;
            try{
              color = colorThief.getColor(image);
              if(color){
                return color;
              }

            }
            catch{
                console.log("getColor failed trying again");
                  currentDate = Date.now();
                  ColorIsSet = (currentDate - date > timelimitinms);
                }

            }
            // let p1 = new Promise((resolve, reject) => {
            //
            //   console.log("Using fallback color value as RGB vector");
            //   resolve(color);
            //
            // });
            // p1.then((value) => {
            //       console.log(value); // "Success!"
            //       if(value==="undefined"){
            //         throw new Error("Can't return color, colorThief timed out, and fallbackfailed to produce a vector");
            //       }
            //       else{
            //         return value;
            //       }
            //
            // })
            //
            //
            // .catch(e=>{
            //   console.error(e.message);
            //   color=[139,0,0];
            //
            //   //darkred
            // })
            // .finally(()=>{
            //   return color;
            // });
            let p1 = new Promise((resolve, reject) => {
              reject(color);});
              p1.then(value=>{
                 throw new Error(value)
              })


            .catch(e =>{
              console.error("Can't return color, colorThief timed out, using fallback vector")

          });
          return [139,0,0];


          }
          getDominantImageColor = async ()=>{
              // get the image
              let sourceImage = movieCover;
              //console.log(movieCover);
              // get the background element
              let background = newNode; //.querySelector(".background");
              //console.log(background);

              // get color palette
              let color = await Integrationliketest(120,sourceImage);
              console.log("rgba(" + color + ",255);");
              // set the background color
              //background.style.background = "rgba(" + color + ",255);";
              console.log(document.getElementById("Movie_P"+i+"_N"+yy).style.background,"Movie_P"+i+"_N"+yy);
              document.getElementById("Movie_P"+i+"_N"+yy).setAttribute("style",document.getElementById("Movie_P"+i+"_N"+yy).getAttribute("style")+" background: rgba(" + color + ",255);");
          }

          //window.onload = async ()=> await
          waitForRender();
          window.addEventListener("renderComplete",getDominantImageColor());
          //setTimeout( , 1200);
          //}

      //});
        }
      }

    })

     .catch(err => console.error(err));

     if((i-1)%40==0){
       sleep(120);
       console.log("halted for 120ms");
     }
     loadedPages=i;
    }
    })

    .catch(err => console.error(err));
    function addPage(str,options)
    {
      fetch(str,options)
     .then(res2 => res2.json())
     .then(res2 => {
       let poster_path;
       let poster_path_arr = [];
       let movieTitle_arr = [];
       let movie_title;

       for (const xx in res2) {

         for (const yy in res2[xx]) {

           poster_path_arr[poster_path_arr.length] = res2[xx][yy].poster_path;
           movieTitle_arr[movieTitle_arr.length] = res2[xx][yy].title;
           console.log(res2[xx][yy].title);
           const newNode = document.createElement("div");
           divElement.appendChild(newNode);
           newNode.setAttribute("class","movieTile");
           newNode.id = "Movie_P"+(loadedPages+1)+"_N"+yy;
           newNode.style.size="500px 750px";
           newNode.style.background="darkred";

           const movieCover = document.createElement("img");
           newNode.appendChild(movieCover);
           movieCover.crossOrigin="anonymous";
           movieCover.setAttribute("class","movieCoverClass");
           movieCover.style.size="100% 100%";
           movieCover.src = "https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path;
           sleep(120);

          // _.defer(function() {
            //alert('This is the deferred function');
            //console.log("This is the deferred function");
           window.addEventListener("fetchcompletion",async function(){
             //console.log("onload");
           getDominantImageColor = ()=>{
               // get the image
               let sourceImage = movieCover;
               //console.log(movieCover);
               // get the background element
               let background = newNode; //.querySelector(".background");
               //console.log(background);
               // initialize colorThief
               let colorThief = new ColorThief();
               // get color palette
               let color = colorThief.getColor(movieCover);
               console.log("rgba(" + color + ",255);");
               // set the background color
               //background.style.background = "rgba(" + color + ",255);";
               newNode.style.background = "rgba(" + color + ",255);";
           }
           getDominantImageColor();
           }
         );
         //});






           const movieTitle = document.createElement("h1");
           newNode.appendChild(movieTitle);
           movieTitle.textContent=res2[xx][yy].title;
           }
         }
         loadedPages+=1;
         addPageCallback = true;
     })
     .catch(err => console.error(err));
    }


    var addPageCallback = true; //not actually a callback, it's used to prevent duplicates from loading.
    window.onscroll = function(ev) {
    if ((window.innerHeight + Math.round(window.scrollY)) >= document.body.offsetHeight) {
        // you're at the bottom of the page => load next page!
        if(loadedPages<pages && addPageCallback)
          {
            console.log("load more pages");
            addPageCallback = false;
            addPage('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page='+(loadedPages+1)+'&sort_by=popularity.desc&with_genres='+genreParam, options);
            window.dispatchEvent(fetchCompletionCallback);
          }
    }
};

document.getElementById("pagetitle").textContent = "EasyFlix/"+nameParam;

window.dispatchEvent(fetchCompletionCallback);


    </script>
  </section>
</body>
</html>
