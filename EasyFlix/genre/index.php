

<!DOCTYPE html>
<html>
  <head> <!-- Access-Control-Allow-Origin="*"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./movieTile.css">
    <link rel="stylesheet" href="../globalStyles.css">
    <!-- Color Thief -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"
      crossorigin="anonymous">
    </script>
    <!-- underscore for defering blocks of code-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"
         crossorigin="anonymous">
    </script> -->
  </head>
<body>
<header class="subPageHeader">
  <a target="_self" href="../">
    <div id='returnHome'>
      <p>Home</p>
  </div></a>
  <a target="_self" href="javascript:history.back()">
    <div id='returnHome'>
      <p>Back</p>
  </div></a>
<!-- <svg viewBox="0 0 300 150"  style="height:10%;
 width: 10%;
 left: 0;
 top: 0; margin-top:-5%; translate:0% 40%;">
    <path id="curve" d="M73.2,148.6c4-6.1,65.5-96.8,178.6-95.6c111.3,1.2,170.8,90.3,175.1,97" style="fill: transparent; width:100%;"/>
    <text width="100" style="/*animation: ease-in-out 2.5s infinite linear;*/font-family: work sans; font-weight:600; fill:darkred; font-size:400%;text-align: center;">
      <textPath xlink:href="#curve">
        EasyFlix
      </textPath>
    </text>
  </svg>
   -->
   <?php
   include("../easyflixheadertitle.svg");
   ?>
   <h1 id="pagetitle"></h1>
</header>
<section>
<!-- Content Starts Here -->
    <div id="response" >
    </div>
    <style media="all">
      /* div>#Movie_P1_N0.movietile */
      *>div:not(.movieTile)
      {
      padding-top: 8%;
      /* padding-top: 5%; */
      }
    </style>
    <ScrollRestoration />
    <script type="text/javascript" crossorigin="anonymous">
    const options = {
      method: 'GET',
      headers: {
        accept: 'application/json',
        Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNzQzYWQ4NWM1MTU1NmUzZDgyMDliYzkwMWVlNzY0NiIsIm5iZiI6MTczMzc0NTkxNy40OTQwMDAyLCJzdWIiOiI2NzU2ZGNmZDZlMGJlZDI2NmI3ZmFiM2QiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.3eEChcFzcTubHssYx6QAOY3yIJlmisJQWH3ynQS7uEA'
      }
    };
    const fetchCompletionCallback = new Event("fetchcompletion",{"bubbles":true,"cancelable":false});
    let count = 0;

    let hrfString = window.location.href.toString();
    let url = new URL(hrfString);
    let genreParam = url.searchParams.get("genre");
    let nameParam = url.searchParams.get("name");
    const divElement = document.getElementById("response");
    const eventRendered = new Event("renderComplete",{"bubbles":true,"cancelable":false});
    const eventLoadNextPage = new Event("loadNextPage",{"bubbles":true,"cancelable":false});
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
  async function LoadContent(){
  let CountRecieved = await fetch('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc&with_genres='+genreParam, options)
    .then(res => res.json())
    .then(res => {
      pages = res.total_pages;
      console.log(res.total_pages);
      console.log(pages);
      let movieCoverClassArrayPageSize;
      count = res.total_results;
      async function asyncWrapper_first10PagesLoad()
        {
          let isReady = [];
          for(let i=1;i<=11;i++)
          {
            isReady[i-1] = await fetch('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page='
              +i
              +'&sort_by=popularity.desc&with_genres='
              +genreParam,
              options)
            .then(res2 => res2.json())
            .then(res2 => {


              let poster_path;
              let poster_path_arr = [];
              let movieTitle_arr = [];
              let movie_title;

              for (const xx in res2) {

                for (const yy in res2[xx]) {
                  if(i == 11)
                    {
                      imageReady = async ()=> {
                          let  t1 = await document.getElementById("Movie_P"+i-1+"_N0");
                          let  t2 = await newNode.getElementsByTagName('img')[0];
                          //t2.src = "https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path;
                         return await movieCover.decode();};
                      return true;
                    }

                  poster_path_arr[poster_path_arr.length] = res2[xx][yy].poster_path;
                  movieTitle_arr[movieTitle_arr.length] = res2[xx][yy].title;
                  //console.log(res2[xx][yy].title);
                  const newNode = document.createElement("div");
                  divElement.appendChild(newNode);
                  newNode.setAttribute("class","movieTile");
                  // newNode.setAttribute("class","movieTile, image-container");
                  newNode.id = "Movie_P"+i+"_N"+yy;
                  //newNode.style.size="750px 500px";
                  newNode.setAttribute("style","size:750px 500px; background:darkred;");

                  const movieCover = document.createElement("img");

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
                    movieCover.src = "https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path+"?not-from-cache-please"; // ?not-from-cache-please is a simple but effective fix for CORS validation lag.
                    newNode.appendChild(movieCover);


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
                  moviePageBtn.style.background="#FFFFFF44";
                  moviePageBtn.style.borderRadius="8px";
                  moviePageBtn.style.fontFamily="Work Sans";
                  moviePageBtn.setAttribute("argument",res2[xx][yy].id);
                  moviePageBtn.setAttribute("argument2",res2[xx][yy].title);
                  moviePageBtn.onclick = function(self){ movieDetailsPage(moviePageBtn.getAttribute("argument"),moviePageBtn.getAttribute("argument2")); }
                  moviePageBtn.style.fontSize="150%";
                  moviePageBtn.style.color="white";
                  // moviePageBtn.setAttribute("style",moviePageBtn.getAttribute("style")
                  //   +);
                  const moviePageBtn_Css = document.createElement("style");
                  moviePageBtn_Css.innerHTML = "div#"+newNode.id+">button{box-shadow: inset black 0px -10px 25px; &:hover{box-shadow: inset var(--contextHover_"+newNode.id+") 0px 10px 25px 2px;}}"
                     newNode.appendChild(moviePageBtn_Css);

                  imageReady = async ()=> { return await movieCover.decode();};
                //_.defer(function() {
                 //alert('This is the deferred function');
                 //console.log("This is the deferred function");
                //window.addEventListener("load",async function(){
                //window.onload = function(){
                //console.log("onload");

                //setTimeout( , 1200);
                //}

            //});
              }
            }


              // await movieCover.onload () => {

            //};
            //sleep(120);
            return imageReady;
            })

            .catch(err => console.error(err))
            // .imageReady(imageReady => imageReady.status)
          }
          //console.log(isReady[9], !isReady[9] == null);
          function areAllPagesReady(arr)
          {
            for(let k=0;k<arr.length;k++)
            {
              if(!arr[k])
                {
                    return false;
                }
            }
            return true;
          }

          if(areAllPagesReady(isReady))
             {
             for(let i=1;i<=10;i++)
                 {
                  // if((i-1)%40==0)
                  // {
                  //   sleep(120);
                  //   console.log("halted for 120ms");
                  // }
                  loadedPages=i;
                  let movieCoverClassArray = document.getElementsByClassName("movieCoverClass");
                  console.log(!movieCoverClassArrayPageSize,movieCoverClassArrayPageSize);
                  if(movieCoverClassArrayPageSize === undefined)
                    {
                      movieCoverClassArrayPageSize=movieCoverClassArray.length/10;
                    }
                  for(j=0;j<movieCoverClassArrayPageSize;j++)
                  {
                      let  newNode = await document.getElementById("Movie_P"+i+"_N"+j);
                      let  movieCover = await newNode.getElementsByTagName('img')[0];
                      console.log(movieCoverClassArray[j],newNode);
                  async function Integrationliketest(timelimitinms,image)
                    {
                      let ColorIsSet = false;
                      const date = Date.now();
                      let currentDate = null;
                      let maxattempts = 20;
                      // initialize colorThief
                      let colorThief = new ColorThief();
                      let color;
                      while(!ColorIsSet)
                        {
                          if(maxattempts==0)
                            {
                              break;
                            }
                          maxattempts--;
                          try
                          {
                            color = colorThief.getColor(image);
                            if(color)
                              {
                                return color;
                              }
                          }
                          catch
                          {
                            console.log("getColor failed trying again");
                            currentDate = Date.now();
                            ColorIsSet = (currentDate - date > timelimitinms);
                          }
                        }
                      let p1 = new Promise((resolve, reject) =>
                                    {
                                        reject(color);
                                    });
                                    p1.then(value=>
                                      {
                                        throw new Error(value)
                                      })
                                        .catch(e =>
                                        {
                                          console.error("Can't return color, colorThief timed out, using fallback vector")
                                        });
                      return [139,0,0];
                    }
                      getDominantImageColor = async ()=>
                    {
                          //console.log(movieCover);
                          // get the background element
                          let background = await document.getElementById("Movie_P"+i+"_N"+j); //.querySelector(".background");
                          //console.log(background);
                          // wrapper to await background image is ready, this might be obsolete now.
                           awaitLoadLastPage = async ()=>
                            {
                              let completed = await background.getElementsByTagName('img')[0].completed;
                              return background.getElementsByTagName('img')[0];
                            }
                            let sourceImage = await awaitLoadLastPage();

                          // get color palette
                          let color = await Integrationliketest(5,sourceImage);
                          //console.log("rgba(" + color + ",255);");
                          // make sure the text is readable after color change;
                          let p = await background.getElementsByTagName('p');
                          let h1 = await background.getElementsByTagName('h1');
                          if(((color[0]+color[1]+color[2])/3)<(255/3)*2){
                            for(var k = 0;k<p.length;k++)
                            {
                                   p[k].style.color = '#fff';

                            }
                            for(var k = 0;k<h1.length;k++)
                            {
                                   h1[k].style.color = '#fff';
                            }
                          }
                          else
                            {
                              for(var k = 0;k<p.length;k++)
                              {
                                     p[k].style.color = '#000';

                              }
                              for(var k = 0;k<h1.length;k++)
                              {
                                     h1[k].style.color = '#000';
                              }
                            }
                          let css = document.createElement("style");
                          css.innerHTML = ":root{--contextHover_"+background.id+": rgba("+color+",255);}";
                          newNode.appendChild(css);
                          // set the background color
                          background.setAttribute("style",background.getAttribute("style")+" background: var(--contextHover_"+newNode.id+");");
                          // console.log(background.style.background,"Movie_P"+i+"_N"+j);
                    }
                    window.addEventListener("renderComplete",getDominantImageColor());
                  }
                if(i==10)
                  {
                    // First 10 pages finished loading, now we can dispatch the the content aware background modification.
                    waitForRender();
                  }
                }
              }
        }

      asyncWrapper_first10PagesLoad();
      })
      .catch(err => console.error(err));

    async function addPage(str,options)
    {
      // let pageReady = new Event("pageReady",{"bubbles":true,"cancelable":false});
      for(let i=0;i<=1;i++)
      {
      let pageReady = await fetch(str,options)
     .then(res2 => res2.json())
     .then(res2 => {
       let poster_path;
       let poster_path_arr = [];
       let movieTitle_arr = [];
       let movie_title;

       for (const xx in res2) {

         for (const yy in res2[xx]) {
           if(i == 1)
             {
               imageReady = async ()=> {
                   let  t1 = await document.getElementById("Movie_P"+loadedPages+"_N0");
                   let  t2 = await newNode.getElementsByTagName('img')[0];
                   //t2.src = "https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path;
                  return await movieCover.decode();};
               return res2;
             }

           poster_path_arr[poster_path_arr.length] = res2[xx][yy].poster_path;
           movieTitle_arr[movieTitle_arr.length] = res2[xx][yy].title;
           console.log(res2[xx][yy].title);
           const newNode = document.createElement("div");
           divElement.appendChild(newNode);
           newNode.setAttribute("class","movieTile");
           newNode.id = "Movie_P"+(loadedPages+1)+"_N"+yy;
           newNode.setAttribute("style","size:750px 500px; background:darkred;");

           const movieCover = document.createElement("img");
           newNode.appendChild(movieCover);
           movieCover.crossOrigin="anonymous";
           movieCover.setAttribute("class","movieCoverClass");
           movieCover.style.size="100% 100%";
           movieCover.src = "https://image.tmdb.org/t/p/w500"+res2[xx][yy].poster_path;
           // sleep(120);

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







           }
         }
         loadedPages+=1;
         addPageCallback = true;
         return res2;
     })

     .catch(err => console.error(err)


     );


     if(pageReady)
       {
         console.log("onload");

         async function Integrationliketest(timelimitinms,image)
           {
             let ColorIsSet = false;
             const date = Date.now();
             let currentDate = null;
             let maxattempts = 20;
             // initialize colorThief
             let colorThief = new ColorThief();
             let color;
             while(!ColorIsSet)
               {
                 if(maxattempts==0)
                   {
                     break;
                   }
                 maxattempts--;
                 try
                 {
                   color = await colorThief.getColor(image);
                   if(color)
                     {
                       return color;
                     }
                 }
                 catch
                 {
                   console.log("getColor failed trying again");
                   currentDate = Date.now();
                   ColorIsSet = (currentDate - date > timelimitinms);
                 }
               }
             let p1 = new Promise((resolve, reject) =>
                           {
                               reject(color);
                           });
                           p1.then(value=>
                             {
                               throw new Error(value)
                             })
                               .catch(e =>
                               {
                                 console.error("Can't return color, colorThief timed out, using fallback vector")
                               });
             return [139,0,0];
           }
         async function getDominantImageColor(container) {

           let background = await container;
           // get the image
            awaitLoadLastPage = async ()=>
            {
              let completed = await background.getElementsByTagName('img')[0].completed;
              return background.getElementsByTagName('img')[0];
            }
           let sourceImage = await awaitLoadLastPage();
           //let colorThief = new ColorThief();
           // get color palette
           let color = await Integrationliketest(5,sourceImage);
           console.log("rgba(" + color + ",255);");
           let p = await background.getElementsByTagName('p');
           let h1 = await background.getElementsByTagName('h1');
           console.log((((color[0]+color[1]+color[2])/3)<(255/3)*2),(color[0]+color[1]+color[2])/3,(255/3)*2)
           if(((color[0]+color[1]+color[2])/3)<(255/3)*2){
             for(var i = 0;i<p.length;i++)
             {
                    p[i].style.color = '#fff';

             }
             for(var i = 0;i<h1.length;i++)
             {
                    h1[i].style.color = '#fff';
             }
           }
           else
             {
               for(var i = 0;i<p.length;i++)
               {
                      p[i].style.color = '#000';

               }
               for(var i = 0;i<h1.length;i++)
               {
                      h1[i].style.color = '#000';
               }
             }

           // set the background color
           //background.style.background = "rgba(" + color + ",255);";
           if(document.documentElement.getAttribute("style") == null){
             document.documentElement.style.setProperty("--contextHover_"+background.id,"rgba("+color+",255);");
           }
           document.documentElement.style.setProperty("--contextHover_"+background.id,"rgba("+color+",255);");
           //document.documentElement.setAttribute("style",document.documentElement.getAttribute("style").replace(/.$/,"--contextHover_"+background.id+": rgba("+color+",255);}"));
           background.setAttribute("style",background.getAttribute("style")+" background: rgba(" + color + ",255);");
       }

         //window.dispatchEvent(fetchCompletionCallback);
         for (const xx in pageReady) {

           for (const yy in pageReady[xx]) {
             let container = document.getElementById("Movie_P"+(loadedPages)+"_N"+yy);
              window.addEventListener("loadNextPage",getDominantImageColor(container));
           }
         }
       }
      }
    }


    var addPageCallback = true; //not actually a callback, it's used to prevent duplicates from loading.
    window.onscroll = function(ev)
    {
      if ((window.innerHeight + Math.round(window.scrollY)) >= document.body.offsetHeight)
        {
          // you're at the bottom of the page => load next page!
          if(loadedPages<pages && addPageCallback)
            {
              console.log("load more pages");
              addPageCallback = false;
              addPage('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page='
                +(loadedPages+1)
                +'&sort_by=popularity.desc&with_genres='
                +genreParam,
                options
              );
              window.dispatchEvent(eventLoadNextPage);
            }
        }
    };

    (count != undefined)
    {
      document.getElementById("pagetitle").textContent
        = "/"
        +nameParam
        +": "+count+" movies";
    }
  }
  LoadContent();
    console.log(window.history.scrollRestoration);
  // window.history.scrollRestoration = "auto"
      // genre_header.textContent=genre_header.textContent;
    window.dispatchEvent(fetchCompletionCallback);
    </script>

  </section>
</body>
</html>
