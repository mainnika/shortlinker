
function _gr(){
    var res = direction;
    var cd = ['north','east','south','west'];
    var dc = {
        'north':0,
        'east':1,
        'south':2,
        'west':3
    };
    do{
        res = cd[(dc[res]+1)%3];
    }while (eval(res)!=0);

    return res;
}

function _gl(){
    var res = direction;
    var cd = ['north','west','south','east'];
    var dc = {
        'north':0,
        'west':1,
        'south':2,
        'east':3
    };
    do{
        res = cd[(dc[res]+1)%3];
    }while (eval(res)!=0);
    
    return res;
}

function _(){
    if (result=='')
        return true;
    return false;
}

if (direction=='')
    result='east';
    
if (_()){
    
    if (last_move!='jaw'){
        result = 'jaw';
    }else{
        
        if (eval(direction)==0){
            result = direction;
        }else{
            if (goo%2==0){
                result = _gl(); 
            }else{
                result = _gr();
            }
        }
    }
    
    
}
