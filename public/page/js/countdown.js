var sec         = time * 60,
    countDiv    = document.getElementById("time"),
    secpass,
    countDown   = setInterval(function () {
        'use strict';
        
        secpass();
    }, 1000);

function secpass() {
    'use strict';
    
    var min     = Math.floor(sec / 60),
        remSec  = sec % 60;
    
    if (min < 1 && sec <=10 ) {
      var f = document.getElementById("time"); f.style.color="#ff0000";
      setInterval(function(){
        $('#time').shake();
      },300); 
          
    }

    if (remSec < 10) {
        
        remSec = '0' + remSec;
    
    }
    if (min < 10) {
        
        min = '0' + min;
    
    }
    countDiv.innerHTML = min + ":" + remSec;
    
    if (sec > 0) {
        
        sec = sec - 1;
        
    } else {
        
        clearInterval(countDown);
        endGame();
       
        
        
    }
}

     
//         if (timer < 11) {
//         var f = document.getElementById("time"); f.style.color="#ff0000";
//     setInterval(function(){
//     $('#time').shake();
//     },300); 
//         }
     
//     if (--timer < 0) {
//         document.getElementById('request-input').value = selectedAnswer;
//         game.classList.remove('activeGame')
//         result.classList.add('activeResult')
//         // document.getElementById('request-form').submit();
//     }
//   }, 1000);
// }
 
 


jQuery.fn.shake = function() {
    this.each(function(i) {
        $(this).css({ "position" : "relative" });
        for (var x = 1; x <= 3; x++) {
            $(this).animate({ left: -5 }, 10).animate({ left: 0 }, 50).animate({ left: 5 }, 10).animate({ left: 0 }, 50);
        }
    });
    return this;
}

