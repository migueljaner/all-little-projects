function addEventOnLoad(addEvent){

    if(addEvent && addEvent.constructor == Function){
        window.addEventListener("load", addEvent);
    }

}