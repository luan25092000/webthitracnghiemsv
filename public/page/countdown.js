var minutes = 0;
var seconds = 0;
function startTimer(duration, display) {
  var timer = duration,
      minutes, seconds;
  setInterval(function() {
    minutes = parseInt(timer / 60, 10);
    seconds = parseInt(timer % 60, 10);
 
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
 
    display.textContent = minutes + ":" + seconds;
 
    setCookie("minutes", minutes.toString(), 1);
    setCookie("seconds", seconds.toString(), 1);
     
        if (timer < 11) {
        var f = document.getElementById("time"); f.style.color="#ff0000";
    setInterval(function(){
    $('#time').shake();
    },300); 
        }
     
    if (--timer < 0) {
        document.getElementById('request-input').value = selectedAnswer;
        game.classList.remove('activeGame')
        result.classList.add('activeResult')
        // document.getElementById('request-form').submit();
    }
  }, 1000);
}
 
 
window.onload = function() {
   var minutes_data = getCookie("minutes");
   var seconds_data = getCookie("seconds");
   var timer_amount = (1.2*10); //default
    if (!minutes_data || !seconds_data){
      //no cookie found use default
    }
    else{
      console.log(minutes_data+" minutes_data at start");
      console.log(seconds_data+" seconds_data at start");
      console.log(parseInt(minutes_data*60)+parseInt(seconds_data));
            timer_amount = parseInt(minutes_data*60)+parseInt(seconds_data)
    }
 
  var fiveMinutes = timer_amount,
      display = document.querySelector('#time');
  startTimer(fiveMinutes, display); //`enter code here`
  
};
 
 function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
 }
  
 function getCookie(cname) {
 var name = cname + "=";
 var ca = document.cookie.split(';');
 for(var i=0; i<ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1);
    if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
 }
 return "";
}

jQuery.fn.shake = function() {
    this.each(function(i) {
        $(this).css({ "position" : "relative" });
        for (var x = 1; x <= 3; x++) {
            $(this).animate({ left: -5 }, 10).animate({ left: 0 }, 50).animate({ left: 5 }, 10).animate({ left: 0 }, 50);
        }
    });
    return this;
}

