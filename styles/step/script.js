$('.tab').css("display","none");
$("#tab-1").css("display","block");

function run(hideTab, showTab){
    // alert('ok')
    if (hideTab < showTab) {
        // déclaration
        var currentTab = 0;
        x = $("#tab-"+hideTab);
        y = $(x).find("input");
        
        for (i = 0; i < y.length; i++) {
            if (y[i].value == "") {
                $(y[i]).css("background","#ffdddd");
                return false;
            }                        
        }
    }

    //progess bar
    for (i = 0; i < showTab; i++) {
        $("#step-"+i).css("opacity","1");                    
    }
    
    // switch tab
    $("#tab-"+hideTab).css("display","none");
    $("#tab-"+showTab).css("display","block");
    $('input').css("background",'#fff'); 
}