// Jquery 


(function($) {
$(document).ready(function() {
    
    $('.tab').on('click', function() {
  
        $(this).siblings('.tab').removeClass('active').end().addClass('active');
         
        var selectContent = this.getAttribute('data-toggle-target');
         
        $('.tab-content').removeClass('active').filter(selectContent).addClass('active');


        return false;
      });
    

})


})(jQuery);








//  Get elements
const upperPropertyPrice = document.getElementById('propertyPriceUpper');
const upperAvailableDeposit = document.getElementById('availableDepositUpper');
const nextButton = document.getElementById('calculatorNext');
const upperNotice = document.getElementById('calculatorUpperNotice');


// Property Upper 

upperPropertyPrice.addEventListener('input', function(){
    nextButtonTrigger();
    
})

// Available Deposit Upper

upperAvailableDeposit.addEventListener('input', function(){
    nextButtonTrigger();
    showUpperNotice();
    
})


// upper notice

function showUpperNotice(){
    if(upperAvailableDeposit.value !== ""){
        upperNotice.style.display = "block";
    }else{
        upperNotice.style.display = "none";
    }
}





// Next Button

nextButton.classList.add('disabled');

function nextButtonTrigger(){

    if (upperPropertyPrice.value == '' || upperAvailableDeposit.value == ''){
        nextButton.classList.add('disabled');
    } 
    else {
        nextButton.classList.remove('disabled'); 
        
        nextButton.addEventListener('click', function () {
          
            document.getElementById('upperContent').style.display = 'none';
        })
    }
}





// Allow only Integer Number On Inputs

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}



// Inistialize Range

var mySlider = new rSlider({
    target: '#termRange',
    values: {
        min: 5,
        max: 40,
    },
    scale: false,
    labels: false,
    step: 1,
    range: false
    
   
    
    
});

var mySlider = new rSlider({
    target: '#interestRange',
    values: {
        min: 0.25,
        max: 15,
    },
    scale: false,
    labels: false,
    step: 0.25,
    range: false
    
   
    
    
});



