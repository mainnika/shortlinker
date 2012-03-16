$(document).ready(function(){
    $("#quickshortform").submit(function(){
        var newurl = shorter($("#quickshortform [name=c]").val(), "");
        if (newurl){
            $("#quickresult").html("<a href=\""+newurl+"\">"+newurl+"</a>");
        }else{
            $("#quickresult").html("error");
        }
        return false;
    })
})

function shorter(url){
    var ret=undefined;
    $.ajax({
        url:"/",
        type:"post",
        data:"c="+url,
        async:false,
        success: function (data){
            if (ret != ""){
                ret=data;
            }else{
                ret=undefined;
            }
        }
    })
    return ret;
}