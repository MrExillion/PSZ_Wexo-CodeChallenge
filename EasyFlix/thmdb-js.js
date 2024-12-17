
function require(path){
  import * as myModule from path+".js";
  return myModule;
}

// const {TmdbClient} = require(['tmdb-js'], function(){
const {TmdbClient} = require('../../../src/tmdb-js/tmdb-js');
   console.log("buh");
   const options = {
     method: 'POST',
     headers: {
       accept: 'application/json',
       'content-type': 'application/json',
       Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNzQzYWQ4NWM1MTU1NmUzZDgyMDliYzkwMWVlNzY0NiIsIm5iZiI6MTczMzc0NTkxNy40OTQwMDAyLCJzdWIiOiI2NzU2ZGNmZDZlMGJlZDI2NmI3ZmFiM2QiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.3eEChcFzcTubHssYx6QAOY3yIJlmisJQWH3ynQS7uEA'
     },
     body: JSON.stringify({username: 'test', password: 'test'})
   };
   const dostuffinput = {'apiKey': options.headers.Authorization, 'username': '', 'password': ''};
   doStuff(dostuffinput);

doStuff = async function(authentication) {

 let apiKey = authentication.apiKey;
 let username = authentication.username;
 let password = authentication.password;

 let tmdb = new TmdbClient(apiKey);
 console.log(tmdb);
 // Get movie data example
 let oceansElevenMovie = tmdb.getMovieSection().getMovie("161");
 let oceansDetails = await oceansElevenMovie.getDetailsAsync();
 let oceansImages = await oceansElevenMovie.getImagesAsync();
 console.log("A great movie: " + oceansDetails.title);

 // Rate movie example
 //let sessionId = await tmdb.getAuthenticator().createSessionAsync("chrome"); // One way of getting a session ID
 //let ratingSuccessful1 = await oceansElevenMovie.rateAsync(10, sessionId);

 // Rate TV show episode example
 //let loginSessionId = await tmdb.getAuthenticator().createLoginSessionAsync(username, password); // Another way of getting a session ID
 let gameOfThronesTvShow = tmdb.getTvShowSection().getTvShow("1399");
 //let ratingSuccessful2 = await gameOfThronesTvShow.getEpisode(3, 9).rateAsync(10, sessionId);

 // Rate TV show as a guest example
 let guestSessionId = await tmdb.getAuthenticator().createGuestSessionAsync();
 // let ratingSuccessful3 = await gameOfThronesTvShow.rateAsync(10, undefined, guestSessionId);

 // Search TMDB examples
 let searchSection = tmdb.getSearchSection();
 let searchResult1 = await searchSection.searchMoviesAsync("Ocean's");
 let searchResult2 = await searchSection.searchMoviesAsync("Ocean's", 1, 1);
 let searchResult3 = await searchSection.multiSearchAsync("Ocean's");
 let searchResult4 = await searchSection.multiSearchAsync("Ocean's", 1, 2);

 console.log(searchResult1,searchResult2,searchResult3,searchResult4);
}
