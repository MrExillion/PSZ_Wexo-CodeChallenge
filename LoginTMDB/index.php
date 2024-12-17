<!doctype php>
 <?php ?>

<!DOCTYPE html>
<!-- <script type="text/javascript" runAt='server' data-main="../requireConfigs" src='../node_modules/requirejs/require.js'>


</script> -->
<!-- <script src="../requireConfigs.js">




</script> -->
 <body>
  <!-- <script src="./thmdb-js.js">

  </script> -->

  <form action="" id="login-form" method="post">
  <label for="username">Username:</label><br>
  <input type="text" id="username" name="username"><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br><br>
  <input type="submit" value="Submit">
</form>
 <script>

const form = document.getElementById('login-form');

form.addEventListener('submit', function(event) {
  const password = document.getElementById('password').value;
  const username = document.getElementById('username').value;
  event.preventDefault();
  // alert(`The password is ${password}`);
  login(username, password);
});


function setCookie(cname, token, id, cexpires) {
  const d = new Date();
  const cvalue = JSON.stringify({session_token: token, session_id:id});
  alert(cvalue);
  document.cookie = cname + "=" + cvalue + ";" + cexpires + ";path=/";
}
function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie()
{
  let user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  }
  else
  {
//    window.location = ""
    if (user != "" && user != null)
     {
       setCookie("username", user, 365);
     }
  }
}


   async function login(username,password)
   {


     console.log(username,password);


   const RequestTokenOptions = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNzQzYWQ4NWM1MTU1NmUzZDgyMDliYzkwMWVlNzY0NiIsIm5iZiI6MTczMzc0NTkxNy40OTQwMDAyLCJzdWIiOiI2NzU2ZGNmZDZlMGJlZDI2NmI3ZmFiM2QiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.3eEChcFzcTubHssYx6QAOY3yIJlmisJQWH3ynQS7uEA'
  }
};

const RequestTokenResponse = await fetch('https://api.themoviedb.org/3/authentication/token/new', RequestTokenOptions)
  .then(res => res.json())
  .then(res => {console.log(res); return res; })
  .catch(err => console.error(err));

if(RequestTokenResponse)
  {
    console.log(RequestTokenResponse);


    const ValidateTokenOptions = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNzQzYWQ4NWM1MTU1NmUzZDgyMDliYzkwMWVlNzY0NiIsIm5iZiI6MTczMzc0NTkxNy40OTQwMDAyLCJzdWIiOiI2NzU2ZGNmZDZlMGJlZDI2NmI3ZmFiM2QiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.3eEChcFzcTubHssYx6QAOY3yIJlmisJQWH3ynQS7uEA'
  }
};

const ValidatedToken = await fetch('https://api.themoviedb.org/3/authentication', ValidateTokenOptions)
  .then(res => res.json())
  .then(res => {console.log(res); return res;})
  .catch(err => console.error(err));

if(ValidatedToken)
  {
    console.log(ValidatedToken);


  const ValidatedTokenLoginOptions = {
    method: 'POST',
    headers: {
      accept: 'application/json',
      'content-type': 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNzQzYWQ4NWM1MTU1NmUzZDgyMDliYzkwMWVlNzY0NiIsIm5iZiI6MTczMzc0NTkxNy40OTQwMDAyLCJzdWIiOiI2NzU2ZGNmZDZlMGJlZDI2NmI3ZmFiM2QiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.3eEChcFzcTubHssYx6QAOY3yIJlmisJQWH3ynQS7uEA'
    },
    body: JSON.stringify({username: username , password: password, request_token: RequestTokenResponse.request_token})
  };

const ValidatedTokenLoginResponse = await  fetch('https://api.themoviedb.org/3/authentication/token/validate_with_login?redirect_to='+window.location.origin+"/EasyFlix", ValidatedTokenLoginOptions)
     .then(res => res.json())
     .then(res => {

        return res;



      })
     .catch(err => console.error(err));
if(ValidatedTokenLoginResponse)
 {

         const SessionIdRequestOptions = {
           method: 'POST',
           headers: {
             accept: 'application/json',
             'content-type': 'application/json',
             Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxNzQzYWQ4NWM1MTU1NmUzZDgyMDliYzkwMWVlNzY0NiIsIm5iZiI6MTczMzc0NTkxNy40OTQwMDAyLCJzdWIiOiI2NzU2ZGNmZDZlMGJlZDI2NmI3ZmFiM2QiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.3eEChcFzcTubHssYx6QAOY3yIJlmisJQWH3ynQS7uEA'
           },
           body: JSON.stringify({request_token: RequestTokenResponse.request_token})
         };
     fetch('https://api.themoviedb.org/3/authentication/session/new', SessionIdRequestOptions)
       .then(res => res.json())
       .then(res => {console.log(res)
         setCookie(username,RequestTokenResponse.request_token,res.session_id,RequestTokenResponse.expires_at); console.log(getCookie(username),res);
         // if('http://localhost:3000' == window.location.origin){
         location.href = "../EasyFlix/";
        // }

       })
       .catch(err => console.error(err));
}
}
}
}

 </script>
</body>

<?php ?>
