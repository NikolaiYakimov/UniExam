

document.addEventListener("DOMContentLoaded", function (){
    const alerts=document.querySelectorAll('.bg-green-50, .bg-red-50');

     alerts.forEach(alert=>{
         //Close the alert after 5 sec.
         const alertCloseTimer=setTimeout(()=>{
                fadeOutAlert(alert);
     },5000);

         //Remove the timer and close the alert with close button
         const closeBtn=alert.querySelector('button');
         if(closeBtn){
             closeBtn.addEventListener('click',()=>{
                 clearTimeout(alertCloseTimer);
               fadeOutAlert(alert);
             })
         }
     })

    function fadeOutAlert(element){
         element.style.opacity='0';
         setTimeout(()=>element.remove(),300)

    }
})
