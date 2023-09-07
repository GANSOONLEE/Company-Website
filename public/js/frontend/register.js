
$(function(){
    $('#datepicker').datepicker();
});

var current = 1;
var steps = $("fieldset").length;

console.log(steps)

setProgressBar(current);

$(".next").click(function(){
    
    current_fs = $(this).parent().parent();
    next_fs = $(this).parent().parent().next();

    console.log(current_fs, next_fs)
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        }, 
        duration: 500
    });
    setProgressBar(++current);
});

$(".previous").click(function(){
    
    current_fs = $(this).parent().parent().parent();
    previous_fs = $(this).parent().parent().parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
        }, 
        duration: 500
    });
    setProgressBar(--current);
});

function setProgressBar(curStep){
    let percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar").css("width",percent+"%")
}

// sensor text input

$('input').on("input", function() {

    var parentElement = $(this).closest("fieldset#first");

    var inputElements = parentElement.find("input");

    var isAnyInputEmpty = false;

    inputElements.each(function() {
        if ($(this).val() === '') {
            isAnyInputEmpty = true;
            return false;
        }
    });

    if (isAnyInputEmpty) {
        $(".next").prop('disabled', true);
        $(".next").addClass('disabled');
    } else {
        check_password()
    }
});

$('input').on("input", function() {

    var parentElement = $(this).closest("fieldset#secondary");

    var inputElements = parentElement.find("input");

    var isAnyInputEmpty = false;

    inputElements.each(function() {
        if ($(this).val() === '') {
            isAnyInputEmpty = true;
            return false;
        }
    });

    if (isAnyInputEmpty) {
        $(".register").prop('disabled', true);
        $(".register").addClass('disabled');
    } else {
        $(".register").prop('disabled', false);
        $(".register").removeClass('disabled');
    }
});

function check_password(){
    let input = document.querySelectorAll('input');
    for(let i = 0; i < input.length; i++){
        input[i].addEventListener('keyup',()=>{
            if($('[name="password"]').val() !== $('[name="password_confirm"]').val()){
                $('label[for="password_confirm"]').addClass('password_not_same');
                $(".next").prop('disabled', true);
                $(".next").addClass('disabled');
            }else{
                $('label[for="password_confirm"]').removeClass('password_not_same');
                $(".next").prop('disabled', false);
                $(".next").removeClass('disabled');
            }
            console.log($('[name="password_confirm"]').val())
        })
    }
}
